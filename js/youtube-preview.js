document.addEventListener('DOMContentLoaded', function() {
    // Função para extrair o ID do vídeo do YouTube de uma URL
    function getYoutubeVideoId(url) {
        if (!url) return null;
        
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // Função para gerar a thumbnail do YouTube
    function generateYoutubeThumbnail(videoId) {
        if (!videoId) return null;
        return `https://img.youtube.com/vi/${videoId}/maxresdefault.jpg`;
    }

    // Função para atualizar previews
    function updatePreviews() {
        const videoInputs = document.querySelectorAll('input[data-youtube-preview]');
        videoInputs.forEach(input => {
            const previewContainer = document.getElementById(input.dataset.youtubePreview);
            if (!previewContainer) return;

            const videoId = getYoutubeVideoId(input.value);
            if (videoId) {
                const thumbnailUrl = generateYoutubeThumbnail(videoId);
                previewContainer.innerHTML = `<img src="${thumbnailUrl}" alt="YouTube Preview" style="max-width: 100%; height: auto;">`;
            } else {
                previewContainer.innerHTML = '<p>Insira uma URL válida do YouTube</p>';
            }
        });
    }

    // Atualizar previews quando a página carrega
    updatePreviews();

    // Atualizar previews quando o input muda
    document.addEventListener('input', function(e) {
        if (e.target.hasAttribute('data-youtube-preview')) {
            updatePreviews();
        }
    });
});
