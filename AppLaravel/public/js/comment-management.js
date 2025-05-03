class CommentManager {
    constructor() {
        this.virtualComments = new VirtualCommentList({
            containerSelector: '.messages',
            itemHeight: 60, // altura aproximada de cada comentário em pixels
            bufferSize: 5, // número de itens extras renderizados acima/abaixo
            loadMoreThreshold: 200 // pixels do fundo para carregar mais
        });
        this.page = 1;
        this.commentsPerPage = 20;
        this.loading = false;
        this.hasMoreComments = true;
        this.currentVideoUuid = null;
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        const debouncedTimeUpdate = this.debounce(this.updateTimeDistribution.bind(this), 250);
        $(document).on('input change', '#vslTimeRange', debouncedTimeUpdate);
        $(document).on('click', '#saveComment', this.handleSaveComments.bind(this));
        $(document).on('change', '.myselectVideo', this.handleVideoSelect.bind(this));
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    handleTimeRangeChange(e) {
        this.totalMinutes = parseInt($(e.target).val());
        this.updateTimeDistribution();
    }

    updateTimeDistribution() {
        const visibleComments = this.virtualComments.getVisibleItems();
        if (!visibleComments.length) return;

        const timeInterval = (this.totalMinutes * 60) / this.virtualComments.getTotalItems();
        
        requestAnimationFrame(() => {
            visibleComments.forEach(comment => {
                const timeInSeconds = Math.floor(timeInterval * comment.index);
                const minutes = Math.floor(timeInSeconds / 60);
                const seconds = timeInSeconds % 60;
                const timeString = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                comment.element.querySelector('.comment-time').textContent = timeString;
            });
        });
    }

    async loadMoreComments() {
        if (this.loading || !this.hasMoreComments || !this.currentVideoUuid) return;

        this.loading = true;
        this.showLoader();

        try {
            const response = await $.get(`/api/comments/${this.currentVideoUuid}`, {
                page: this.page,
                per_page: this.commentsPerPage
            });

            const newComments = response.data;
            this.hasMoreComments = response.next_page_url !== null;

            if (newComments.length) {
                this.virtualComments.addItems(newComments);
                this.page++;
            }
        } catch (error) {
            console.error('Error loading comments:', error);
            toastr.error('Error loading comments. Please try again.');
        } finally {
            this.loading = false;
            this.hideLoader();
        }
    }

    showLoader() {
        if (!document.querySelector('.comments-loader')) {
            const loader = document.createElement('div');
            loader.className = 'comments-loader text-center py-3';
            loader.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `;
            document.querySelector('.messages').appendChild(loader);
        }
    }

    hideLoader() {
        const loader = document.querySelector('.comments-loader');
        if (loader) loader.remove();
    }

    handleVideoSelect(e) {
        const videoUuid = $(e.target).val();
        if (!videoUuid || videoUuid.length === 0) return;
        
        this.currentVideoUuid = videoUuid;
        this.virtualComments.items = [];
        this.page = 1;
        this.hasMoreComments = true;
        this.loading = false;
        
        // Limpar a área de mensagens
        $('.messages').empty();
        
        // Mostrar indicador de carregamento
        $('.messages').append('<div class="text-center my-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Carregando...</span></div></div>');
        
        // Construir a URL para buscar os comentários
        let url = `/comments/get/${videoUuid}`;
        
        // Fazer a requisição AJAX
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: (response) => {
                // Remover o indicador de carregamento
                $('.messages').empty();
                
                if (response.comments && response.comments.length > 0) {
                    // Adicionar os comentários à lista virtual
                    const formattedComments = response.comments.map(comment => ({
                        id: comment.id || Math.random().toString(36).substr(2, 9),
                        text: comment.comment || '',
                        timestamp: comment.timestamp || 0
                    }));
                    
                    this.virtualComments.addItems(formattedComments);
                    this.updateTimeDistribution();
                } else {
                    // Mostrar mensagem de nenhum comentário encontrado
                    $('.messages').html('<div class="text-center my-3">Nenhum comentário encontrado para este vídeo.</div>');
                }
            },
            error: (xhr, status, error) => {
                // Remover o indicador de carregamento e mostrar mensagem de erro
                $('.messages').empty().html(`<div class="alert alert-danger">Erro ao carregar comentários: ${error}</div>`);
                console.error('Erro ao carregar comentários:', error);
            }
        });
    }
}

class VirtualCommentList {
    constructor(options) {
        this.container = document.querySelector(options.containerSelector);
        this.itemHeight = options.itemHeight;
        this.bufferSize = options.bufferSize;
        this.loadMoreThreshold = options.loadMoreThreshold;
        this.items = [];
        this.visibleItems = new Map();
        this.scrollTop = 0;
        this.viewportHeight = 0;
        
        this.setupContainer();
        this.bindEvents();
    }

    setupContainer() {
        this.container.style.position = 'relative';
        this.container.style.overflow = 'auto';
        this.viewport = document.createElement('div');
        this.viewport.style.position = 'relative';
        this.container.appendChild(this.viewport);
    }

    bindEvents() {
        const throttledScroll = this.throttle(this.onScroll.bind(this), 16);
        this.container.addEventListener('scroll', throttledScroll);
        window.addEventListener('resize', this.throttle(this.onResize.bind(this), 100));
        this.onResize();
    }

    throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    onScroll() {
        this.scrollTop = this.container.scrollTop;
        this.updateVisibleItems();
    }

    onResize() {
        this.viewportHeight = this.container.clientHeight;
        this.updateVisibleItems();
    }

    addItems(newItems) {
        const startIndex = this.items.length;
        this.items.push(...newItems);
        this.viewport.style.height = `${this.items.length * this.itemHeight}px`;
        this.updateVisibleItems();
    }

    updateVisibleItems() {
        const startIndex = Math.max(0, Math.floor(this.scrollTop / this.itemHeight) - this.bufferSize);
        const endIndex = Math.min(
            this.items.length,
            Math.ceil((this.scrollTop + this.viewportHeight) / this.itemHeight) + this.bufferSize
        );

        // Remove items that are no longer visible
        for (const [index, element] of this.visibleItems.entries()) {
            if (index < startIndex || index >= endIndex) {
                element.remove();
                this.visibleItems.delete(index);
            }
        }

        // Add new visible items
        for (let i = startIndex; i < endIndex; i++) {
            if (i >= this.items.length) break;
            if (!this.visibleItems.has(i)) {
                const element = this.createCommentElement(this.items[i], i);
                element.style.position = 'absolute';
                element.style.top = `${i * this.itemHeight}px`;
                element.style.width = '100%';
                this.viewport.appendChild(element);
                this.visibleItems.set(i, element);
            }
        }
    }

    createCommentElement(comment, index) {
        const element = document.createElement('div');
        element.className = 'comment-item';
        element.innerHTML = `
            <div class="d-flex gap-2">
                <div class="user-avatar-container">
                    <div class="rounded-full user-avatar" style="background-color: ${comment.color || '#000'}">
                        ${comment.author[0]}
                    </div>
                </div>
                <div class="comment-content">
                    <strong>${comment.author}</strong>
                    <span class="comment-time"></span>
                    <p>${comment.text}</p>
                </div>
            </div>
        `;
        return element;
    }

    getVisibleItems() {
        return Array.from(this.visibleItems.entries()).map(([index, element]) => ({
            index,
            element,
            data: this.items[index]
        }));
    }

    getTotalItems() {
        return this.items.length;
    }
}

// Inicializa o gerenciador de comentários quando o documento estiver pronto
$(document).ready(() => {
    window.commentManager = new CommentManager();
});
