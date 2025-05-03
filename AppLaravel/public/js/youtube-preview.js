document.addEventListener('DOMContentLoaded', function() {
    // Elementos do formulário
    const videoTitleInput = document.getElementById('videoNameId');
    const videoDescriptionInput = document.getElementById('videoDescriptionId');
    const channelNameInput = document.getElementById('channelNameId');
    const shortCodeInput = document.getElementById('videoShortCodeId');
    const templateSelector = document.getElementById('templateSelector');

    // Elementos do preview
    const youtubeTemplate = document.getElementById('youtube-preview-template');
    const instagramTemplate = document.getElementById('instagram-preview-template');

    // Vídeo e texto padrão
    const DEFAULT_VIDEO_ID = '_W9R2czlRtE';
    const DEFAULT_DESCRIPTION = `watching now<br>Started streaming on on 12 Jan 2025 | Lofi Girl - Radios<br> | Listen on Spotify, Apple music and more`;
    const DEFAULT_VIEW_COUNT = '18,533 watching now';

    // Inicialização dos templates
    if (youtubeTemplate) youtubeTemplate.style.display = 'block';
    if (instagramTemplate) instagramTemplate.style.display = 'none';

    // Evento de mudança do template
    if (templateSelector) {
        templateSelector.addEventListener('change', function(e) {
            const selectedTemplate = e.target.value;
            
            // Atualiza o campo hidden
            const hiddenInput = document.getElementById('selectedTemplateInput');
            if (hiddenInput) {
                hiddenInput.value = selectedTemplate;
            }
            
            // Atualiza a visibilidade dos templates
            if (youtubeTemplate) youtubeTemplate.style.display = selectedTemplate === 'youtube' ? 'block' : 'none';
            if (instagramTemplate) instagramTemplate.style.display = selectedTemplate === 'instagram' ? 'block' : 'none';
            
            // Atualiza o preview do template selecionado
            if (selectedTemplate === 'youtube') {
                updateYoutubePreview();
            } else if (selectedTemplate === 'instagram') {
                updateInstagramPreview();
            }
        });
    }

    // Função para atualizar o preview do YouTube
    function updateYoutubePreview() {
        const title = videoTitleInput?.value || 'VEJA COMO FUNCIONA A PLATAFORMA';
        const description = videoDescriptionInput?.value || DEFAULT_DESCRIPTION;
        const channelName = channelNameInput?.value || '';
        const shortCode = shortCodeInput?.value || DEFAULT_VIDEO_ID;
        const viewCount = '18,533';

        // Atualiza os elementos do template
        const titleElement = document.querySelector('#youtube-preview-template #showName');
        const descElement = document.querySelector('#youtube-preview-template #showDescription');
        const viewElement = document.querySelector('#youtube-preview-template #showMaxNumValue');
        const iframeElement = document.querySelector('#youtube-preview-template #showShortCodeLink');

        if (titleElement) titleElement.textContent = title;
        if (descElement) descElement.innerHTML = description;
        if (viewElement) viewElement.textContent = viewCount;
        if (iframeElement) iframeElement.src = `https://www.youtube.com/embed/${shortCode}`;
    }

    // Função para atualizar o preview do Instagram
    function updateInstagramPreview() {
        const title = videoTitleInput?.value || 'Live no Instagram';
        const channelName = channelNameInput?.value || '';
        const viewCount = '1.000';

        // Atualiza os elementos do template
        const titleElement = document.querySelector('#instagram-preview-template #showName');
        const viewElement = document.querySelector('#instagram-preview-template #showMaxNumValue');
        const iframeElement = document.querySelector('#instagram-preview-template #showShortCodeLink');

        if (titleElement) titleElement.textContent = title;
        if (viewElement) viewElement.textContent = viewCount;
        if (iframeElement && shortCodeInput?.value) {
            iframeElement.src = `https://www.instagram.com/p/${shortCodeInput.value}/embed`;
        }
    }

    // Atualizar previews quando os campos são alterados
    videoTitleInput?.addEventListener('input', function() {
        const selectedTemplate = templateSelector?.value;
        if (selectedTemplate === 'youtube') {
            updateYoutubePreview();
        } else {
            updateInstagramPreview();
        }
    });

    videoDescriptionInput?.addEventListener('input', function() {
        if (templateSelector?.value === 'youtube') {
            updateYoutubePreview();
        }
    });

    channelNameInput?.addEventListener('input', function() {
        const selectedTemplate = templateSelector?.value;
        if (selectedTemplate === 'youtube') {
            updateYoutubePreview();
        } else {
            updateInstagramPreview();
        }
    });

    shortCodeInput?.addEventListener('input', function() {
        const selectedTemplate = templateSelector?.value;
        if (selectedTemplate === 'youtube') {
            updateYoutubePreview();
        } else {
            updateInstagramPreview();
        }
    });

    // Inicializa o preview do template atual
    const initialTemplate = templateSelector?.value || 'youtube';
    if (initialTemplate === 'youtube') {
        updateYoutubePreview();
    } else {
        updateInstagramPreview();
    }
});
