import React, { useState, useEffect } from 'react';
import { useRouter } from 'next/router';
import { anunciosApi, Anuncio, AnuncioFilters, PaginatedResponse } from '../api/anunciosApi';
import Link from 'next/link';

const AnunciosLista: React.FC = () => {
  const router = useRouter();
  const [anuncios, setAnuncios] = useState<Anuncio[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);
  const [totalItems, setTotalItems] = useState<number>(0);
  const [currentPage, setCurrentPage] = useState<number>(1);
  const [totalPages, setTotalPages] = useState<number>(1);
  const [perPage, setPerPage] = useState<number>(10);
  
  // Filtros
  const [filtros, setFiltros] = useState<AnuncioFilters>({
    titulo: '',
    tag_principal: '',
    status: '',
    sort_by: 'created_at',
    sort_direction: 'desc',
    per_page: perPage,
    page: 1
  });

  // Carregar anúncios
  const carregarAnuncios = async () => {
    try {
      setLoading(true);
      const response: PaginatedResponse<Anuncio> = await anunciosApi.getAnuncios(filtros);
      
      setAnuncios(response.data);
      setTotalItems(response.meta.total);
      setCurrentPage(response.meta.current_page);
      setTotalPages(response.meta.last_page);
      setError(null);
    } catch (err) {
      setError('Erro ao carregar anúncios. Tente novamente mais tarde.');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  // Carregar anúncios quando o componente montar ou os filtros mudarem
  useEffect(() => {
    carregarAnuncios();
  }, [filtros]);

  // Alterar página
  const alterarPagina = (pagina: number) => {
    setFiltros(prev => ({ ...prev, page: pagina }));
  };

  // Alterar filtros
  const handleFilterChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFiltros(prev => ({ ...prev, [name]: value, page: 1 }));
  };

  // Alterar ordenação
  const alterarOrdenacao = (campo: string) => {
    setFiltros(prev => ({
      ...prev,
      sort_by: campo,
      sort_direction: prev.sort_by === campo && prev.sort_direction === 'asc' ? 'desc' : 'asc',
      page: 1
    }));
  };

  // Limpar filtros
  const limparFiltros = () => {
    setFiltros({
      titulo: '',
      tag_principal: '',
      status: '',
      sort_by: 'created_at',
      sort_direction: 'desc',
      per_page: perPage,
      page: 1
    });
  };

  // Excluir anúncio
  const excluirAnuncio = async (id: string) => {
    if (window.confirm('Tem certeza que deseja excluir este anúncio?')) {
      try {
        await anunciosApi.deleteAnuncio(id);
        carregarAnuncios();
      } catch (err) {
        setError('Erro ao excluir anúncio. Tente novamente mais tarde.');
        console.error(err);
      }
    }
  };

  // Formatar data
  const formatarData = (data: string) => {
    return new Date(data).toLocaleDateString('pt-BR');
  };

  // Renderizar indicador de ordenação
  const renderSortIndicator = (campo: string) => {
    if (filtros.sort_by === campo) {
      return filtros.sort_direction === 'asc' ? '↑' : '↓';
    }
    return '';
  };

  // Renderizar cor do badge conforme tag principal
  const getBadgeColor = (tag: string) => {
    switch (tag) {
      case 'ESCALANDO':
        return 'bg-success';
      case 'TESTE':
        return 'bg-warning';
      case 'PAUSADO':
        return 'bg-secondary';
      default:
        return 'bg-info';
    }
  };

  // Renderizar cor do badge conforme status
  const getStatusBadgeColor = (status: string) => {
    switch (status) {
      case 'Ativo':
        return 'bg-success';
      case 'Inativo':
        return 'bg-danger';
      default:
        return 'bg-secondary';
    }
  };

  return (
    <div className="container-fluid">
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h1 className="h3">Anúncios</h1>
        <Link href="/anuncios/novo" passHref>
          <button className="btn btn-primary">
            <i className="fas fa-plus me-2"></i> Novo Anúncio
          </button>
        </Link>
      </div>

      {error && (
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      )}

      <div className="card shadow-sm mb-4">
        <div className="card-header bg-white">
          <h5 className="mb-0">Filtros</h5>
        </div>
        <div className="card-body">
          <div className="row g-3">
            <div className="col-md-4">
              <label htmlFor="titulo" className="form-label">Título</label>
              <input
                type="text"
                className="form-control"
                id="titulo"
                name="titulo"
                value={filtros.titulo || ''}
                onChange={handleFilterChange}
                placeholder="Buscar por título..."
              />
            </div>
            <div className="col-md-3">
              <label htmlFor="tag_principal" className="form-label">Tag Principal</label>
              <select
                className="form-select"
                id="tag_principal"
                name="tag_principal"
                value={filtros.tag_principal || ''}
                onChange={handleFilterChange}
              >
                <option value="">Todas</option>
                <option value="ESCALANDO">ESCALANDO</option>
                <option value="TESTE">TESTE</option>
                <option value="PAUSADO">PAUSADO</option>
              </select>
            </div>
            <div className="col-md-3">
              <label htmlFor="status" className="form-label">Status</label>
              <select
                className="form-select"
                id="status"
                name="status"
                value={filtros.status || ''}
                onChange={handleFilterChange}
              >
                <option value="">Todos</option>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
              </select>
            </div>
            <div className="col-md-2 d-flex align-items-end">
              <button
                className="btn btn-outline-secondary w-100"
                onClick={limparFiltros}
              >
                Limpar Filtros
              </button>
            </div>
          </div>
        </div>
      </div>

      <div className="card shadow-sm">
        <div className="card-body">
          <div className="table-responsive">
            <table className="table table-hover table-striped">
              <thead>
                <tr>
                  <th scope="col" className="cursor-pointer" onClick={() => alterarOrdenacao('titulo')}>
                    Título {renderSortIndicator('titulo')}
                  </th>
                  <th scope="col" className="cursor-pointer" onClick={() => alterarOrdenacao('tag_principal')}>
                    Tag Principal {renderSortIndicator('tag_principal')}
                  </th>
                  <th scope="col" className="cursor-pointer" onClick={() => alterarOrdenacao('data_anuncio')}>
                    Data {renderSortIndicator('data_anuncio')}
                  </th>
                  <th scope="col" className="cursor-pointer" onClick={() => alterarOrdenacao('status')}>
                    Status {renderSortIndicator('status')}
                  </th>
                  <th scope="col" className="text-center">Criativos</th>
                  <th scope="col" className="text-center">Variação Diária</th>
                  <th scope="col" className="text-center">Ações</th>
                </tr>
              </thead>
              <tbody>
                {loading ? (
                  <tr>
                    <td colSpan={7} className="text-center py-4">
                      <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Carregando...</span>
                      </div>
                    </td>
                  </tr>
                ) : anuncios.length === 0 ? (
                  <tr>
                    <td colSpan={7} className="text-center py-4">
                      Nenhum anúncio encontrado
                    </td>
                  </tr>
                ) : (
                  anuncios.map((anuncio) => (
                    <tr key={anuncio.id}>
                      <td>
                        <Link href={`/anuncios/${anuncio.id}`} passHref>
                          <a className="text-decoration-none text-dark fw-bold">
                            {anuncio.titulo}
                          </a>
                        </Link>
                      </td>
                      <td>
                        <span className={`badge ${getBadgeColor(anuncio.tag_principal)} px-3 py-2`}>
                          {anuncio.tag_principal}
                        </span>
                      </td>
                      <td>{formatarData(anuncio.data_anuncio)}</td>
                      <td>
                        <span className={`badge ${getStatusBadgeColor(anuncio.status)} px-3 py-2`}>
                          {anuncio.status}
                        </span>
                      </td>
                      <td className="text-center">
                        <span className="badge bg-primary px-3 py-2">
                          {anuncio.criativos_count || anuncio.numero_criativos || 0}
                        </span>
                      </td>
                      <td className="text-center">
                        {anuncio.variacao_diaria !== undefined && anuncio.variacao_diaria !== null ? (
                          <span className={`badge ${anuncio.variacao_diaria >= 0 ? 'bg-success' : 'bg-danger'} px-3 py-2`}>
                            {anuncio.variacao_diaria >= 0 ? '+' : ''}{anuncio.variacao_diaria}
                          </span>
                        ) : (
                          <span className="text-muted">-</span>
                        )}
                      </td>
                      <td className="text-center">
                        <div className="btn-group" role="group">
                          <Link href={`/anuncios/${anuncio.id}`} passHref>
                            <button className="btn btn-sm btn-outline-primary" title="Ver detalhes">
                              <i className="fas fa-eye"></i>
                            </button>
                          </Link>
                          <Link href={`/anuncios/${anuncio.id}/editar`} passHref>
                            <button className="btn btn-sm btn-outline-secondary" title="Editar">
                              <i className="fas fa-edit"></i>
                            </button>
                          </Link>
                          <button
                            className="btn btn-sm btn-outline-danger"
                            title="Excluir"
                            onClick={() => excluirAnuncio(anuncio.id)}
                          >
                            <i className="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>

          {/* Paginação */}
          {totalPages > 1 && !loading && (
            <div className="d-flex justify-content-between align-items-center mt-4">
              <div>
                Mostrando {anuncios.length} de {totalItems} itens
              </div>
              <nav aria-label="Navegação de páginas">
                <ul className="pagination">
                  <li className={`page-item ${currentPage === 1 ? 'disabled' : ''}`}>
                    <button
                      className="page-link"
                      onClick={() => alterarPagina(currentPage - 1)}
                      disabled={currentPage === 1}
                    >
                      Anterior
                    </button>
                  </li>
                  {Array.from({ length: totalPages }, (_, i) => i + 1).map((page) => (
                    <li key={page} className={`page-item ${currentPage === page ? 'active' : ''}`}>
                      <button
                        className="page-link"
                        onClick={() => alterarPagina(page)}
                      >
                        {page}
                      </button>
                    </li>
                  ))}
                  <li className={`page-item ${currentPage === totalPages ? 'disabled' : ''}`}>
                    <button
                      className="page-link"
                      onClick={() => alterarPagina(currentPage + 1)}
                      disabled={currentPage === totalPages}
                    >
                      Próxima
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default AnunciosLista; 