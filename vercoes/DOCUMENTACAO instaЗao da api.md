# Documentação do Sistema de Anúncios

## Implementações Realizadas

### Correção de Rotas

1. **Problema Identificado:**
   - As rotas para "anúncios" e "criativos" estavam definidas como recursos sem o prefixo "admin." nos nomes das rotas
   - No entanto, nos arquivos de views e navegação, as rotas eram referenciadas com o prefixo "admin."
   - Isso causava o erro: `Route [admin.anuncios.create] not defined`

2. **Solução Implementada:**
   - Modificamos o arquivo `AppLaravel/routes/admin.php` para incluir o método `names()` nas definições de recursos
   - Adicionamos o prefixo "admin." em todas as rotas de anúncios e criativos
   
   ```php
   // Rotas para gestão de anúncios
   Route::resource('anuncios', AnuncioController::class)->names([
       'index' => 'admin.anuncios.index',
       'create' => 'admin.anuncios.create',
       'store' => 'admin.anuncios.store',
       'show' => 'admin.anuncios.show',
       'edit' => 'admin.anuncios.edit',
       'update' => 'admin.anuncios.update',
       'destroy' => 'admin.anuncios.destroy',
   ]);
   
   Route::resource('criativos', CriativoController::class)->names([
       'index' => 'admin.criativos.index',
       'create' => 'admin.criativos.create',
       'store' => 'admin.criativos.store',
       'show' => 'admin.criativos.show',
       'edit' => 'admin.criativos.edit',
       'update' => 'admin.criativos.update',
       'destroy' => 'admin.criativos.destroy',
   ]);
   ```

3. **Verificação da Solução:**
   - Limpamos o cache de rotas com `php artisan route:clear`
   - Limpamos o cache da aplicação com `php artisan cache:clear`
   - Verificamos que as rotas foram criadas corretamente com `php artisan route:list`

4. **Resultado:**
   - As rotas agora estão definidas corretamente com o prefixo "admin."
   - A interface de navegação exibe e acessa corretamente os itens de menu para anúncios e criativos
   - As páginas são carregadas sem erros

## Integração do Frontend Next.js com a API de Anúncios do Laravel

### 1. Configuração do Ambiente Next.js

#### Instalação e Configuração Inicial

```bash
# Criar um novo projeto Next.js
npx create-next-app@latest anuncios-frontend
cd anuncios-frontend

# Instalar dependências para chamadas de API
npm install axios swr
```

#### Configuração de Variáveis de Ambiente

Crie um arquivo `.env.local` na raiz do projeto:

```
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

### 2. Criação de Serviço de API

Crie um arquivo `services/api.js`:

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
});

// Interceptor para adicionar token de autenticação
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default api;
```

### 3. Autenticação com Laravel Sanctum

#### Configuração do Laravel Sanctum

Certifique-se de que o Laravel Sanctum está configurado corretamente no backend:

1. Configure o CORS no arquivo `config/cors.php`:
   ```php
   'paths' => ['api/*', 'sanctum/csrf-cookie'],
   'allowed_origins' => ['http://localhost:3000'],
   'supports_credentials' => true,
   ```

#### Serviço de Autenticação no Next.js

Crie um arquivo `services/auth.js`:

```javascript
import api from './api';

export const login = async (email, password) => {
  // Primeiro obtenha o cookie CSRF
  await api.get('/sanctum/csrf-cookie');
  
  // Depois faça login
  const response = await api.post('/login', { email, password });
  
  // Armazene o token retornado
  if (response.data.token) {
    localStorage.setItem('token', response.data.token);
  }
  
  return response.data;
};

export const logout = async () => {
  const response = await api.post('/logout');
  localStorage.removeItem('token');
  return response.data;
};

export const isAuthenticated = () => {
  return !!localStorage.getItem('token');
};
```

### 4. Serviços para CRUD de Anúncios

Crie um arquivo `services/anuncios.js`:

```javascript
import api from './api';

export const getAnuncios = async (filtros = {}) => {
  const params = new URLSearchParams();
  
  // Adicionar filtros à query string
  Object.entries(filtros).forEach(([key, value]) => {
    if (value) params.append(key, value);
  });
  
  const query = params.toString() ? `?${params.toString()}` : '';
  
  return api.get(`/anuncios${query}`);
};

export const getAnuncio = async (id) => {
  return api.get(`/anuncios/${id}`);
};

export const criarAnuncio = async (dadosAnuncio) => {
  // Para envio de arquivos, use FormData
  const formData = new FormData();
  
  Object.entries(dadosAnuncio).forEach(([key, value]) => {
    if (key === 'imagem' && value instanceof File) {
      formData.append(key, value);
    } else {
      formData.append(key, value);
    }
  });
  
  return api.post('/anuncios', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  });
};

export const atualizarAnuncio = async (id, dadosAnuncio) => {
  const formData = new FormData();
  
  // Adicionar método _method para simular PUT
  formData.append('_method', 'PUT');
  
  Object.entries(dadosAnuncio).forEach(([key, value]) => {
    if (key === 'imagem' && value instanceof File) {
      formData.append(key, value);
    } else {
      formData.append(key, value);
    }
  });
  
  return api.post(`/anuncios/${id}`, formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  });
};

export const excluirAnuncio = async (id) => {
  return api.delete(`/anuncios/${id}`);
};
```

### 5. Componentes React para Anúncios

#### Lista de Anúncios

Crie um arquivo `components/anuncios/ListaAnuncios.js`:

```javascript
import { useState, useEffect } from 'react';
import { getAnuncios } from '../../services/anuncios';
import Link from 'next/link';

export default function ListaAnuncios() {
  const [anuncios, setAnuncios] = useState([]);
  const [loading, setLoading] = useState(true);
  const [filtros, setFiltros] = useState({
    titulo: '',
    tag_principal: '',
    status: '',
    nicho: ''
  });
  
  const carregarAnuncios = async () => {
    setLoading(true);
    try {
      const response = await getAnuncios(filtros);
      setAnuncios(response.data.data);
    } catch (error) {
      console.error("Erro ao carregar anúncios:", error);
    } finally {
      setLoading(false);
    }
  };
  
  useEffect(() => {
    carregarAnuncios();
  }, []);
  
  const handleFiltroChange = (e) => {
    setFiltros({
      ...filtros,
      [e.target.name]: e.target.value
    });
  };
  
  const aplicarFiltros = (e) => {
    e.preventDefault();
    carregarAnuncios();
  };
  
  return (
    <div className="container">
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h1>Anúncios</h1>
        <Link href="/anuncios/criar">
          <a className="btn btn-primary">Novo Anúncio</a>
        </Link>
      </div>
      
      <div className="card mb-4">
        <div className="card-header">Filtros</div>
        <div className="card-body">
          <form onSubmit={aplicarFiltros}>
            <div className="row">
              <div className="col-md-3 mb-3">
                <label htmlFor="titulo" className="form-label">Título</label>
                <input
                  type="text"
                  className="form-control"
                  id="titulo"
                  name="titulo"
                  value={filtros.titulo}
                  onChange={handleFiltroChange}
                />
              </div>
              <div className="col-md-3 mb-3">
                <label htmlFor="tag_principal" className="form-label">Tag Principal</label>
                <select
                  className="form-select"
                  id="tag_principal"
                  name="tag_principal"
                  value={filtros.tag_principal}
                  onChange={handleFiltroChange}
                >
                  <option value="">Todas</option>
                  <option value="ESCALANDO">ESCALANDO</option>
                  <option value="TESTE">TESTE</option>
                  <option value="PAUSADO">PAUSADO</option>
                </select>
              </div>
              <div className="col-md-3 mb-3">
                <label htmlFor="status" className="form-label">Status</label>
                <select
                  className="form-select"
                  id="status"
                  name="status"
                  value={filtros.status}
                  onChange={handleFiltroChange}
                >
                  <option value="">Todos</option>
                  <option value="Ativo">Ativo</option>
                  <option value="Inativo">Inativo</option>
                </select>
              </div>
              <div className="col-md-3 mb-3">
                <label htmlFor="nicho" className="form-label">Nicho</label>
                <input
                  type="text"
                  className="form-control"
                  id="nicho"
                  name="nicho"
                  value={filtros.nicho}
                  onChange={handleFiltroChange}
                />
              </div>
            </div>
            <div className="text-end">
              <button type="submit" className="btn btn-primary">Filtrar</button>
              <button
                type="button"
                className="btn btn-secondary ms-2"
                onClick={() => {
                  setFiltros({
                    titulo: '',
                    tag_principal: '',
                    status: '',
                    nicho: ''
                  });
                }}
              >
                Limpar
              </button>
            </div>
          </form>
        </div>
      </div>
      
      {loading ? (
        <div className="text-center">
          <div className="spinner-border" role="status">
            <span className="visually-hidden">Carregando...</span>
          </div>
        </div>
      ) : (
        <div className="card">
          <div className="card-header">Lista de Anúncios</div>
          <div className="card-body p-0">
            <div className="table-responsive">
              <table className="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Tag Principal</th>
                    <th>Data</th>
                    <th>Nicho</th>
                    <th>País</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  {anuncios.length > 0 ? (
                    anuncios.map((anuncio) => (
                      <tr key={anuncio.id}>
                        <td>{anuncio.id}</td>
                        <td>
                          {anuncio.imagem ? (
                            <img
                              src={`${process.env.NEXT_PUBLIC_API_URL}/storage/${anuncio.imagem}`}
                              alt={anuncio.titulo}
                              width="50"
                              className="img-thumbnail"
                            />
                          ) : (
                            <div className="text-center text-muted">
                              <i className="fas fa-image fa-2x"></i>
                            </div>
                          )}
                        </td>
                        <td>{anuncio.titulo}</td>
                        <td>
                          <span className={`badge ${
                            anuncio.tag_principal === 'ESCALANDO'
                              ? 'bg-success'
                              : anuncio.tag_principal === 'TESTE'
                              ? 'bg-info'
                              : 'bg-warning'
                          }`}>
                            {anuncio.tag_principal}
                          </span>
                        </td>
                        <td>{new Date(anuncio.data_anuncio).toLocaleDateString()}</td>
                        <td>{anuncio.nicho}</td>
                        <td>{anuncio.pais_codigo}</td>
                        <td>
                          <span className={`badge ${
                            anuncio.status === 'Ativo' ? 'bg-success' : 'bg-danger'
                          }`}>
                            {anuncio.status}
                          </span>
                        </td>
                        <td>
                          <div className="d-flex gap-2">
                            <Link href={`/anuncios/editar/${anuncio.id}`}>
                              <a className="btn btn-sm btn-primary">
                                <i className="fas fa-edit"></i>
                              </a>
                            </Link>
                            <button
                              className="btn btn-sm btn-danger"
                              onClick={() => excluirAnuncioHandler(anuncio.id)}
                            >
                              <i className="fas fa-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))
                  ) : (
                    <tr>
                      <td colSpan="9" className="text-center py-4">
                        <div className="text-muted">
                          <i className="fas fa-search me-2"></i> Nenhum anúncio encontrado
                        </div>
                      </td>
                    </tr>
                  )}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
```

#### Formulário de Anúncio

Crie um arquivo `components/anuncios/FormularioAnuncio.js`:

```javascript
import { useState, useEffect } from 'react';
import { useRouter } from 'next/router';
import { getAnuncio, criarAnuncio, atualizarAnuncio } from '../../services/anuncios';

export default function FormularioAnuncio({ id = null }) {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [enviando, setEnviando] = useState(false);
  const [anuncio, setAnuncio] = useState({
    titulo: '',
    descricao: '',
    tag_principal: 'TESTE',
    data_anuncio: new Date().toISOString().split('T')[0],
    nicho: '',
    pais_codigo: 'BR',
    status: 'Ativo',
    imagem: null
  });
  const [previewImagem, setPreviewImagem] = useState(null);
  
  useEffect(() => {
    if (id) {
      carregarAnuncio(id);
    }
  }, [id]);
  
  const carregarAnuncio = async (anuncioId) => {
    setLoading(true);
    try {
      const response = await getAnuncio(anuncioId);
      const dadosAnuncio = response.data;
      setAnuncio({
        ...dadosAnuncio,
        data_anuncio: new Date(dadosAnuncio.data_anuncio).toISOString().split('T')[0]
      });
      
      if (dadosAnuncio.imagem) {
        setPreviewImagem(`${process.env.NEXT_PUBLIC_API_URL}/storage/${dadosAnuncio.imagem}`);
      }
    } catch (error) {
      console.error("Erro ao carregar anúncio:", error);
      alert("Erro ao carregar dados do anúncio");
    } finally {
      setLoading(false);
    }
  };
  
  const handleChange = (e) => {
    const { name, value, files } = e.target;
    
    if (name === 'imagem' && files.length > 0) {
      const file = files[0];
      setAnuncio({ ...anuncio, imagem: file });
      
      // Criar preview da imagem
      const reader = new FileReader();
      reader.onloadend = () => {
        setPreviewImagem(reader.result);
      };
      reader.readAsDataURL(file);
    } else {
      setAnuncio({ ...anuncio, [name]: value });
    }
  };
  
  const handleSubmit = async (e) => {
    e.preventDefault();
    setEnviando(true);
    
    try {
      if (id) {
        await atualizarAnuncio(id, anuncio);
        alert("Anúncio atualizado com sucesso!");
      } else {
        await criarAnuncio(anuncio);
        alert("Anúncio criado com sucesso!");
      }
      router.push('/anuncios');
    } catch (error) {
      console.error("Erro ao salvar anúncio:", error);
      alert("Erro ao salvar anúncio. Verifique os dados e tente novamente.");
    } finally {
      setEnviando(false);
    }
  };
  
  if (loading) {
    return (
      <div className="text-center py-5">
        <div className="spinner-border" role="status">
          <span className="visually-hidden">Carregando...</span>
        </div>
      </div>
    );
  }
  
  return (
    <div className="container">
      <h1>{id ? 'Editar Anúncio' : 'Novo Anúncio'}</h1>
      
      <div className="card">
        <div className="card-body">
          <form onSubmit={handleSubmit}>
            <div className="row mb-3">
              <div className="col-md-6">
                <label htmlFor="titulo" className="form-label">Título *</label>
                <input
                  type="text"
                  className="form-control"
                  id="titulo"
                  name="titulo"
                  value={anuncio.titulo}
                  onChange={handleChange}
                  required
                />
              </div>
              <div className="col-md-6">
                <label htmlFor="data_anuncio" className="form-label">Data *</label>
                <input
                  type="date"
                  className="form-control"
                  id="data_anuncio"
                  name="data_anuncio"
                  value={anuncio.data_anuncio}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>
            
            <div className="row mb-3">
              <div className="col-md-4">
                <label htmlFor="tag_principal" className="form-label">Tag Principal *</label>
                <select
                  className="form-select"
                  id="tag_principal"
                  name="tag_principal"
                  value={anuncio.tag_principal}
                  onChange={handleChange}
                  required
                >
                  <option value="ESCALANDO">ESCALANDO</option>
                  <option value="TESTE">TESTE</option>
                  <option value="PAUSADO">PAUSADO</option>
                </select>
              </div>
              <div className="col-md-4">
                <label htmlFor="nicho" className="form-label">Nicho *</label>
                <input
                  type="text"
                  className="form-control"
                  id="nicho"
                  name="nicho"
                  value={anuncio.nicho}
                  onChange={handleChange}
                  required
                />
              </div>
              <div className="col-md-4">
                <label htmlFor="status" className="form-label">Status *</label>
                <select
                  className="form-select"
                  id="status"
                  name="status"
                  value={anuncio.status}
                  onChange={handleChange}
                  required
                >
                  <option value="Ativo">Ativo</option>
                  <option value="Inativo">Inativo</option>
                </select>
              </div>
            </div>
            
            <div className="mb-3">
              <label htmlFor="descricao" className="form-label">Descrição</label>
              <textarea
                className="form-control"
                id="descricao"
                name="descricao"
                rows="4"
                value={anuncio.descricao || ''}
                onChange={handleChange}
              ></textarea>
            </div>
            
            <div className="mb-3">
              <label htmlFor="imagem" className="form-label">Imagem</label>
              <input
                type="file"
                className="form-control"
                id="imagem"
                name="imagem"
                accept="image/*"
                onChange={handleChange}
              />
              
              {previewImagem && (
                <div className="mt-2">
                  <img
                    src={previewImagem}
                    alt="Preview"
                    className="img-thumbnail"
                    style={{ maxWidth: '200px' }}
                  />
                </div>
              )}
            </div>
            
            <div className="d-flex justify-content-between">
              <button
                type="button"
                className="btn btn-secondary"
                onClick={() => router.push('/anuncios')}
              >
                Cancelar
              </button>
              <button
                type="submit"
                className="btn btn-primary"
                disabled={enviando}
              >
                {enviando ? (
                  <>
                    <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Salvando...
                  </>
                ) : (
                  'Salvar Anúncio'
                )}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}
```

### 6. Páginas do Next.js

#### Página de Lista de Anúncios

Crie um arquivo `pages/anuncios/index.js`:

```javascript
import { useEffect } from 'react';
import { useRouter } from 'next/router';
import ListaAnuncios from '../../components/anuncios/ListaAnuncios';
import { isAuthenticated } from '../../services/auth';

export default function AnunciosPage() {
  const router = useRouter();
  
  useEffect(() => {
    // Verificar autenticação
    if (!isAuthenticated()) {
      router.push('/login');
    }
  }, []);

  return <ListaAnuncios />;
}
```

#### Página de Criação de Anúncio

Crie um arquivo `pages/anuncios/criar.js`:

```javascript
import { useEffect } from 'react';
import { useRouter } from 'next/router';
import FormularioAnuncio from '../../components/anuncios/FormularioAnuncio';
import { isAuthenticated } from '../../services/auth';

export default function CriarAnuncioPage() {
  const router = useRouter();
  
  useEffect(() => {
    // Verificar autenticação
    if (!isAuthenticated()) {
      router.push('/login');
    }
  }, []);

  return <FormularioAnuncio />;
}
```

#### Página de Edição de Anúncio

Crie um arquivo `pages/anuncios/editar/[id].js`:

```javascript
import { useEffect } from 'react';
import { useRouter } from 'next/router';
import FormularioAnuncio from '../../../components/anuncios/FormularioAnuncio';
import { isAuthenticated } from '../../../services/auth';

export default function EditarAnuncioPage() {
  const router = useRouter();
  const { id } = router.query;
  
  useEffect(() => {
    // Verificar autenticação
    if (!isAuthenticated()) {
      router.push('/login');
    }
  }, []);

  if (!id) {
    return (
      <div className="text-center py-5">
        <div className="spinner-border" role="status">
          <span className="visually-hidden">Carregando...</span>
        </div>
      </div>
    );
  }

  return <FormularioAnuncio id={id} />;
}
```

### 7. Configuração da API no Laravel

Para que a API do Laravel funcione corretamente com o frontend Next.js, é necessário:

1. Configurar as rotas da API no arquivo `routes/api.php`:

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnuncioController;
use App\Http\Controllers\Api\AuthController;

// Rotas de autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    // Rota para obter usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Rotas para anúncios
    Route::apiResource('anuncios', AnuncioController::class);
});
```

2. Criar controllers específicos para a API:

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    public function index(Request $request)
    {
        $query = Anuncio::query();
        
        // Aplicar filtros
        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }
        
        if ($request->has('tag_principal') && $request->tag_principal) {
            $query->where('tag_principal', $request->tag_principal);
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('nicho') && $request->nicho) {
            $query->where('nicho', 'like', '%' . $request->nicho . '%');
        }
        
        $anuncios = $query->with('criativos')->paginate(10);
        
        return response()->json($anuncios);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tag_principal' => 'required|string',
            'data_anuncio' => 'required|date',
            'nicho' => 'required|string|max:255',
            'pais_codigo' => 'required|string|max:2',
            'status' => 'required|string|in:Ativo,Inativo',
            'imagem' => 'nullable|image|max:2048',
        ]);
        
        $dados = $request->all();
        
        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('anuncios', 'public');
        }
        
        $anuncio = Anuncio::create($dados);
        
        return response()->json($anuncio, 201);
    }
    
    public function show($id)
    {
        $anuncio = Anuncio::with('criativos')->findOrFail($id);
        return response()->json($anuncio);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'tag_principal' => 'required|string',
            'data_anuncio' => 'required|date',
            'nicho' => 'required|string|max:255',
            'pais_codigo' => 'required|string|max:2',
            'status' => 'required|string|in:Ativo,Inativo',
            'imagem' => 'nullable|image|max:2048',
        ]);
        
        $anuncio = Anuncio::findOrFail($id);
        $dados = $request->all();
        
        if ($request->hasFile('imagem')) {
            // Remover imagem antiga se existir
            if ($anuncio->imagem) {
                Storage::disk('public')->delete($anuncio->imagem);
            }
            
            $dados['imagem'] = $request->file('imagem')->store('anuncios', 'public');
        }
        
        $anuncio->update($dados);
        
        return response()->json($anuncio);
    }
    
    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        
        // Remover imagem se existir
        if ($anuncio->imagem) {
            Storage::disk('public')->delete($anuncio->imagem);
        }
        
        $anuncio->delete();
        
        return response()->json(null, 204);
    }
}
```

### 8. Considerações Finais

Para uma implementação completa, considere:

1. Adicionar paginação e gerenciamento de estado mais robusto (Redux, React Context)
2. Implementar notificações de sucesso/erro mais elegantes (React-Toastify, etc.)
3. Adicionar validação de formulários no lado do cliente (Formik, React-Hook-Form)
4. Implementar tratamento de erros mais sofisticado
5. Adicionar testes unitários e de integração

Este guia fornece uma base sólida para a integração do frontend Next.js com a API de Anúncios do Laravel, seguindo boas práticas de desenvolvimento e facilitando a manutenção do código. 