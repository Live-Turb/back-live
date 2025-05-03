// API client para comunicação com o backend Laravel
import axios from 'axios';

// Criar uma instância do axios com configuração base
const api = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  withCredentials: true, // importante para cookies de autenticação
});

// Tipos de dados
export interface Anuncio {
  id: string;
  titulo: string;
  tag_principal: 'ESCALANDO' | 'TESTE' | 'PAUSADO';
  data_anuncio: string;
  nicho: string;
  pais_codigo: string;
  status: 'Ativo' | 'Inativo';
  novo_anuncio: boolean;
  destaque: boolean;
  tags: string[];
  imagem?: string;
  url_video?: string;
  transcricao?: string;
  produto_tipo: string;
  produto_estrutura: string;
  produto_idioma: string;
  produto_rede_trafego: string;
  produto_funil_vendas: string;
  link_pagina_anuncio?: string;
  link_criativos_fb?: string;
  link_anuncios_escalados?: string;
  link_site_cloaker?: string;
  variacao_diaria?: number;
  variacao_semanal?: number;
  numero_anuncios?: number;
  numero_criativos?: number;
  criativos_count?: number;
  created_at: string;
  updated_at: string;
}

export interface Criativo {
  id: string;
  anuncio_id: string;
  titulo: string;
  tag?: string;
  url: string;
  creativeId?: string;
  platform: string;
  language: string;
  idioma: string;
  image?: string;
  views?: number;
  caption?: string;
  status: 'Ativo' | 'Inativo' | 'Pendente';
  value?: number;
  created_at: string;
  updated_at: string;
  anuncio?: Anuncio;
}

export interface PaginatedResponse<T> {
  data: T[];
  meta: {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
  };
}

export interface AnuncioFilters {
  titulo?: string;
  tag_principal?: string;
  status?: string;
  nicho?: string;
  data_inicio?: string;
  data_fim?: string;
  sort_by?: string;
  sort_direction?: 'asc' | 'desc';
  per_page?: number;
  page?: number;
}

export interface CriativoFilters {
  anuncio_id?: string;
  titulo?: string;
  tag?: string;
  platform?: string;
  language?: string;
  idioma?: string;
  status?: string;
  sort_by?: string;
  sort_direction?: 'asc' | 'desc';
  per_page?: number;
  page?: number;
}

// Funções para gerenciar anúncios
export const anunciosApi = {
  // Listar anúncios com filtros
  getAnuncios: async (filters: AnuncioFilters = {}): Promise<PaginatedResponse<Anuncio>> => {
    try {
      const { data } = await api.get('/anuncios', { params: filters });
      return data;
    } catch (error) {
      console.error('Erro ao buscar anúncios:', error);
      throw error;
    }
  },

  // Obter um anúncio específico
  getAnuncio: async (id: string): Promise<Anuncio> => {
    try {
      const { data } = await api.get(`/anuncios/${id}`);
      return data;
    } catch (error) {
      console.error(`Erro ao buscar anúncio ${id}:`, error);
      throw error;
    }
  },

  // Criar um novo anúncio
  createAnuncio: async (anuncioData: FormData): Promise<Anuncio> => {
    try {
      const { data } = await api.post('/anuncios', anuncioData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      return data;
    } catch (error) {
      console.error('Erro ao criar anúncio:', error);
      throw error;
    }
  },

  // Atualizar um anúncio
  updateAnuncio: async (id: string, anuncioData: FormData): Promise<Anuncio> => {
    try {
      // Para métodos PUT com FormData, precisamos adicionar o método _method
      anuncioData.append('_method', 'PUT');
      
      const { data } = await api.post(`/anuncios/${id}`, anuncioData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      return data;
    } catch (error) {
      console.error(`Erro ao atualizar anúncio ${id}:`, error);
      throw error;
    }
  },

  // Excluir um anúncio
  deleteAnuncio: async (id: string): Promise<void> => {
    try {
      await api.delete(`/anuncios/${id}`);
    } catch (error) {
      console.error(`Erro ao excluir anúncio ${id}:`, error);
      throw error;
    }
  },
};

// Funções para gerenciar criativos
export const criativosApi = {
  // Listar criativos com filtros
  getCriativos: async (filters: CriativoFilters = {}): Promise<PaginatedResponse<Criativo>> => {
    try {
      const { data } = await api.get('/criativos', { params: filters });
      return data;
    } catch (error) {
      console.error('Erro ao buscar criativos:', error);
      throw error;
    }
  },

  // Obter criativos de um anúncio específico
  getCriativosByAnuncio: async (anuncioId: string, filters: CriativoFilters = {}): Promise<PaginatedResponse<Criativo>> => {
    try {
      const { data } = await api.get(`/anuncios/${anuncioId}/criativos`, { params: filters });
      return data;
    } catch (error) {
      console.error(`Erro ao buscar criativos do anúncio ${anuncioId}:`, error);
      throw error;
    }
  },

  // Obter um criativo específico
  getCriativo: async (id: string): Promise<Criativo> => {
    try {
      const { data } = await api.get(`/criativos/${id}`);
      return data;
    } catch (error) {
      console.error(`Erro ao buscar criativo ${id}:`, error);
      throw error;
    }
  },

  // Criar um novo criativo
  createCriativo: async (criativoData: FormData): Promise<Criativo> => {
    try {
      const { data } = await api.post('/criativos', criativoData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      return data;
    } catch (error) {
      console.error('Erro ao criar criativo:', error);
      throw error;
    }
  },

  // Atualizar um criativo
  updateCriativo: async (id: string, criativoData: FormData): Promise<Criativo> => {
    try {
      // Para métodos PUT com FormData, precisamos adicionar o método _method
      criativoData.append('_method', 'PUT');
      
      const { data } = await api.post(`/criativos/${id}`, criativoData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });
      return data;
    } catch (error) {
      console.error(`Erro ao atualizar criativo ${id}:`, error);
      throw error;
    }
  },

  // Excluir um criativo
  deleteCriativo: async (id: string): Promise<void> => {
    try {
      await api.delete(`/criativos/${id}`);
    } catch (error) {
      console.error(`Erro ao excluir criativo ${id}:`, error);
      throw error;
    }
  },
}; 