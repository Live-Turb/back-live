@props([
    'videoTitle' => 'Live no Instagram',
    'viewCount' => '1.000',
    'comments' => [],
    'shortCode' => '',
    'user' => null,
    'commentfrequeny' => null
])

<div class="position-relative w-100 mx-auto bg-black instagram-container" id="instagram-preview-template">
    <!-- Gradiente de sobreposição -->
    <div class="position-absolute w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.1), transparent, rgba(0,0,0)); pointer-events: none; z-index: 2;"></div>
    
    <!-- Área do vídeo -->
    <div class="w-100 bg-dark video-container position-absolute overflow-hidden" id="instagram-video-container">
        @if($shortCode)
            <div class="video-wrapper">
                {!! $shortCode !!}
            </div>
        @endif
    </div>

    <!-- Cabeçalho -->
    <div class="position-absolute top-0 start-0 end-0 p-4 d-flex align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="position-relative">
                <div class="position-absolute inset-0 pulse-ring"></div>
                <div class="position-absolute inset-0 pulse-ring" style="animation-delay: -1s"></div>
                
                <!-- Avatar do canal - usando a mesma lógica do YouTube template -->
                <div class="rounded-circle overflow-hidden position-relative" id="profile-avatar" style="width: 40px; height: 40px; z-index: 10; display: flex; align-items: center; justify-content: center;">
                    @if($user && $user->profile_picture_path)
                        <img src="{{ asset('storage/' . $user->profile_picture_path) }}" class="w-100 h-100" style="object-fit: cover;">
                    @else
                        @php
                            $channelName = $user ? $user->name : 'Canal';
                            $initial = strtoupper(substr($channelName, 0, 1));
                            $backgroundColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                        @endphp
                        <div style="background-color: {{ $backgroundColor }}; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <span class="text-white fw-bold">{{ $initial }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <h2 id="showName" class="text-white fw-bold mb-0" style="font-size: 0.9rem;">{{ $user ? $user->name : 'Canal' }}</h2>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3 ms-auto">
            <span class="bg-danger text-white px-2 py-1 rounded-pill" style="font-size: 0.7rem;">AO VIVO</span>
            <div class="bg-black bg-opacity-50 rounded-pill px-2 py-1 d-flex align-items-center gap-1">
                <i class="fa-regular fa-eye text-white" style="font-size: 0.8rem;"></i>
                <span id="showMaxNumValue" class="text-white" style="font-size: 0.8rem;">{{ $viewCount }}</span>
            </div>
        </div>
    </div>

    <!-- Container de comentários -->
    <div id="live-comments" class="position-absolute start-0 end-0 px-4 live-comments-section">
        <div class="instagram-comments-container">
            @php
                // Array com nomes aleatórios para autores, igual ao usado no template do YouTube
                $authorNames = [
                    'John Doe', 'Jane Smith', 'Brad Castor', 'Michael Smith', 'Emma Johnson', 'William Davis', 'Sophia Anderson', 
                    'James Wilson', 'Isabella Miller', 'Alexander Moore', 'Olivia Brown', 'Daniel Taylor', 'Charlotte Harris', 
                    'Matthew Clark', 'Ava Martinez', 'David Thompson', 'Mia Robinson', 'Joseph Wright', 'Emily Turner',
                    'Benjamin Cooper', 'Abigail Parker', 'Christopher Lee', 'Elizabeth Grant', 'Andrew Jackson', 
                    'Sarah Collins', 'John Adams', 'Madison Foster', 'Thomas Jefferson', 'Victor Hughes',
                    'Robert White', 'Grace Williams', 'Richard King'
                ];
            
                $getRandomColor = function() {
                    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                };
            @endphp

            @if(is_array($comments) && count($comments) > 0)
                <!-- Os comentários serão exibidos pelo JavaScript de forma dinâmica -->
            @elseif(is_object($comments) && method_exists($comments, 'isEmpty') && !$comments->isEmpty())
                <!-- Os comentários serão exibidos pelo JavaScript de forma dinâmica -->
            @else
                <p class="pt-1 no-comment text-white" style="text-align:center;font-size:0.8rem;">Sem comentários disponíveis</p>
            @endif
        </div>
    </div>

    <!-- Controles inferiores -->
    <div class="position-absolute bottom-0 start-0 end-0 p-4 d-flex align-items-center gap-3 controls-container">
        <input type="text" placeholder="Adicione um comentário..." class="form-control bg-black bg-opacity-50 text-white rounded-pill add-comment-input">
        <button class="btn text-white p-0 like-btn"><i class="fa-regular fa-heart"></i></button>
        <button class="btn text-white p-0 send-btn-comment"><i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>

<style>
@keyframes commentAnimation {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-comment {
    animation: commentAnimation 0.5s ease-out forwards;
}

/* Estilo principal do container do Instagram */
.instagram-container {
    aspect-ratio: 9/16;
    max-width: 400px;
    height: 100%;
}

/* Controla o container de vídeo e iframes */
#instagram-video-container {
    top: 0;
    left: 0;
    right: 0;
    height: calc(100% - 72px);
    overflow: hidden;
    z-index: 1;
}

.video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    pointer-events: auto;
}

/* Ajustando z-index dos elementos sobrepostos */
.position-absolute.top-0,
.controls-container,
#live-comments {
    z-index: 3;
}

/* Container de comentários */
#live-comments {
    bottom: 72px;
    height: 200px;
    overflow-y: auto;
}

/* Animação para o contador de visualizações */
@keyframes text-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.text-pulse {
    animation: text-pulse 0.5s ease;
}

/* Adiciona estilo para comentários ocultos */
.hidden-comment {
    display: none;
}

/* Controla a posição absoluta dos iframes de vídeo */
#instagram-video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.comment-avatar2 {
    width: 35px;
    height: 35px;
    display: flex;
    font-size: 16px;
    align-items: center;
    justify-content: center;
    color: white;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
}

.live-comments-section {
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE and Edge */
    /* Removendo as máscaras de gradiente que podem causar efeito de desfoque */
    /* mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%); */
    /* Efeito de desfoque e gradiente de fundo */
    /* backdrop-filter: blur(3px) ;
    -webkit-backdrop-filter: blur(3px); */
    /* Ajustando o gradiente de fundo para ser mais suave e não interferir no último comentário */
    background-image: linear-gradient(to top, 
                     rgba(0, 0, 0, 0.49) 0%, 
                     rgba(0, 0, 0, 0.15) 20%, 
                     rgba(0, 0, 0, 0) 50%);
    scroll-behavior: smooth; /* Adiciona comportamento de rolagem suave */
    /* Garantindo que o último comentário não seja afetado pelo container */
    padding-bottom: 10px;
}

.live-comments-section::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

/* Adiciona contraste para melhorar a legibilidade dos comentários */
.live-comments-section .d-flex.flex-row span {
    text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.5); /* Reduzindo a intensidade da sombra */
    font-size: 0.9rem;
}

.no-comment {
    opacity: 0.7;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.5;
    }
    100% {
        transform: scale(1.4);
        opacity: 0;
    }
}

/* Definição para classe inset-0 */
.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.pulse-ring {
    border-radius: 50%;
    border: 2px solid #fff;
    animation: pulse 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
    z-index: 5;
}

.instagram-comments-container {
    display: flex;
    flex-direction: column;
    gap: 2px; /* Espaçamento consistente entre comentários */
    padding-top: 2px; /* Espaço no topo para evitar comentários cortados */
    padding-bottom: 8px; /* Espaço no fundo para evitar comentários cortados */
}

.comment-item {
    width: 100%;
    min-height: 30px; /* Altura mínima para cada comentário */
    margin-bottom: 3px; /* Espaçamento fixo entre comentários */
}

/* Responsividade para dispositivos móveis */
@media (max-width: 767px) {
    .instagram-container {
        aspect-ratio: unset;
        max-width: 100%;
        width: 100%;
        height: 100%;
    }
    
    #instagram-video-container {
        height: calc(100% - 72px);
        width: 100vw;
        left: 0;
        right: 0;
    }
    
    /* Garante a visibilidade da barra de controle */
    .controls-container {
        height: 72px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.4), transparent);
        padding: 12px !important;
        position: fixed !important;
        bottom: 0 !important;
    }
    
    #live-comments {
        max-height: 40%;
        bottom: 80px;
        position: fixed !important;
    }
    
    /* Especificamente para iPhone */
    @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .controls-container {
            padding-bottom: calc(1rem + env(safe-area-inset-bottom)) !important;
        }
        
        #live-comments {
            bottom: calc(80px + env(safe-area-inset-bottom));
        }
    }
    
    /* Ajustes específicos para iPhone X e similares com entalhes */
    @media screen and (device-width: 375px) and (device-height: 812px),
           screen and (device-width: 390px) and (device-height: 844px),
           screen and (device-width: 414px) and (device-height: 896px),
           screen and (device-width: 428px) and (device-height: 926px) {
        .controls-container {
            bottom: 0 !important;
            padding-bottom: calc(1.5rem + env(safe-area-inset-bottom)) !important;
        }
        
        #live-comments {
            bottom: calc(90px + env(safe-area-inset-bottom));
        }
        
        /* Ajusta o tamanho da área de vídeo */
        #instagram-video-container {
            height: calc(100% - 90px - env(safe-area-inset-bottom));
        }
    }
    
    /* Específico para Android - forçar o preenchimento completo */
    .video-wrapper, .video-wrapper iframe {
        width: 100vw;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        object-fit: cover;
        object-position: center;
    }
}
</style>

<script>
// Armazena os comentários a serem exibidos
let instagramComments = [];
let currentCommentIndex = 0;
let commentDisplayTimer = null;

document.addEventListener('DOMContentLoaded', function() {
    // Garantir que o iframe de vídeo não ultrapasse os limites
    fixVideoPosition();
    
    // Inicializa visualizações aleatórias
    function updateRandomNumber() {
        var incrementRange = [1, 2, 3, 5, 7, 10, 15];
        var randomIncrement = incrementRange[Math.floor(Math.random() * incrementRange.length)];

        if (Math.random() < 0.7) {
            var currentVal = parseInt(document.getElementById('showMaxNumValue').textContent.replace(/\./g, '').replace(/,/g, ''));
            currentVal += randomIncrement;

            // Formata o número para o padrão brasileiro com pontos como separadores de milhar
            var formattedVal = currentVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            document.getElementById('showMaxNumValue').textContent = formattedVal;
            document.getElementById('showMaxNumValue').classList.add('text-pulse');
            
            setTimeout(function() {
                document.getElementById('showMaxNumValue').classList.remove('text-pulse');
            }, 500);
        }
        
        // Define o próximo intervalo aleatório para atualização
        var nextUpdate = Math.floor(Math.random() * (8000 - 2000 + 1)) + 2000;
        setTimeout(updateRandomNumber, nextUpdate);
    }
    
    // Inicia a atualização dos números
    setTimeout(updateRandomNumber, 3000);

    // Inicializa os comentários
    initializeComments();
    
    // Adiciona o evento para enviar o comentário com clique no botão
    document.querySelector('.send-btn-comment').addEventListener('click', function() {
        let commentText = document.querySelector('.add-comment-input').value.trim();
        if (commentText !== '') {
            addComment(commentText);
            
            // Chamada AJAX para gerar resposta
            sendCommentToAi(commentText);
        }
    });
    
    // Adiciona o evento para enviar o comentário com Enter
    document.querySelector('.add-comment-input').addEventListener('keypress', function(e) {
        if (e.which === 13) { 
            let commentText = this.value.trim();
            if (commentText !== '') {
                addComment(commentText);
                
                // Chamada AJAX para gerar resposta
                sendCommentToAi(commentText);
            }
        }
    });
});

// Função para adicionar o comentário do usuário
function addComment(commentText) {
    const commentContainer = document.querySelector('.instagram-comments-container');
    
    // Remover mensagem de "sem comentários" se existir
    const noCommentElement = document.querySelector('.no-comment');
    if (noCommentElement) {
        noCommentElement.style.display = 'none';
    }
    
    // Criar o elemento de comentário do usuário
    const commentElement = document.createElement('div');
    commentElement.className = 'd-flex flex-row gap-2 animate-comment comment-item my-comment';
    
    commentElement.innerHTML = `
        <div class="d-flex align-items-center me-2">
            <div class="comment-avatar2 user-avatar" style="background-color: #3498db;">
                <span style="display: block;">U</span>
            </div>
        </div>
        <div style="flex: 1;">
            <div class="d-flex flex-column">
                <span style="font-size: 12px; font-weight: 700; color: white; margin-bottom: 2px;">
                    Você
                </span>
                <span style="font-size: 0.85rem; color: white; word-break: break-word;">
                    ${commentText}
                </span>
            </div>
        </div>
    `;
    
    // Adicionar o comentário ao contêiner
    commentContainer.appendChild(commentElement);
    
    // Limitador de comentários na tela - manter apenas os últimos 6 comentários
    const commentElements = commentContainer.querySelectorAll('.comment-item');
    if (commentElements.length > 6) {
        commentContainer.removeChild(commentElements[0]);
    }
    
    // Rolar para o novo comentário
    commentElement.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'end' 
    });
    
    // Limpar o campo de entrada
    document.querySelector('.add-comment-input').value = '';
}

// Função para enviar o comentário para a IA
function sendCommentToAi(commentText) {
    // Chamada AJAX para gerar resposta de IA
    fetch('{{ route('generate.comment.ajax') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            commentText: commentText
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Response generated') {
            // Função para aleatorizar a ordem dos elementos
            function shuffle(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }
            
            // Lista de nomes de autores aleatórios
            let authorNames = [
                'John Doe', 'Jane Smith', 'Alex Johnson', 'Chris Lee', 
                'Patricia Brown', 'Michaella Davis', 'Jessica Garcia', 'Matthew Martinez',
                'Liam O Connor', 'Sofia Rossi', 'Lucas Oliveira', 'Isabella Fernández',
                'Ethan Patel', 'Mia Kowalski', 'Benjamin Silva', 'Ava Nguyen', 
                'Noah Muller', 'Oliver Chen', 'Emily Ivanov', 'Aria Ward', 
                'Henry Clark', 'Layla Harris', 'Chloe Martin', 'Daniela Singh', 
                'Sophie Dubois', 'Oscar Gómez', 'Elena Petrova', 'Mohammed Al-Farsi', 
                'Aisha Khan', 'Yuki Tanaka', 'Javier Morales', 'Camila Santos', 
                'Ravi Mehta', 'Zara Ahmed', 'Nina Popov', 'Fernando Ruiz', 
                'Clara Jansen', 'William Thompson', 'Amara Okafor', 'Mason Kim', 
                'Hiroshi Yamamoto', 'Fatima El-Sayed', 'Emily Kim', 'Sebastian Schwarz', 
                'Lara Fischer', 'Ahmed Mustafa', 'Victor Hughes', 'Dmitry Kozlov', 
                'Priya Sharma', 'Gabriella Costa', 'Katarina Novak', 'Leonardo Romano', 
                'Yasmin Ali', 'Jakub Nowak', 'Hannah Carter', 'Jheniffer Jenkins', 
                'Matteo Ricci', 'Maria Rodrigues', 'Yusuf Ibrahim', 'Elsa Svensson', 
                'Nikolai Volkov'
            ];
            
            // Aleatorizar a ordem dos nomes
            shuffle(authorNames);
            
            // Função para gerar cor aleatória
            function randomColor() {
                return '#' + Math.floor(Math.random() * 16777215).toString(16);
            }
            
            // Criar array com os novos comentários da IA
            let newComments = [];
            
            data.comments.forEach(function(comment, index) {
                let author = authorNames[Math.floor(Math.random() * authorNames.length)];
                let initial = author.charAt(0).toUpperCase();
                let backgroundColor = randomColor();
                let authorFormatted = author.replace(/\s+/g, '_');
                
                newComments.push({
                    author: author,
                    authorFormatted: authorFormatted,
                    initial: initial,
                    backgroundColor: backgroundColor,
                    comment: comment,
                    index: currentCommentIndex + index
                });
            });
            
            // Adicionar os novos comentários ao array existente
            instagramComments = instagramComments.concat(newComments);
            
            // Agendar a exibição dos novos comentários
            let minSec = 2; // Fixo em 2 segundos
            let maxSec = {{ isset($commentfrequeny) ? $commentfrequeny->max_Sec : 10 }};
            
            // Exibir o primeiro comentário da IA após um intervalo curto
            setTimeout(function() {
                showNextComment();
                
                // Agendar os demais comentários
                for (let i = 1; i < newComments.length; i++) {
                    setTimeout(showNextComment, minSec * 1000 * i + (Math.random() * maxSec * 1000));
                }
            }, 3000);
        } else {
            console.error('Falha ao gerar resposta:', data.message);
        }
    })
    .catch(error => {
        console.error('Erro na solicitação AJAX:', error);
    });
}

// Função para inicializar comentários de forma dinâmica
function initializeComments() {
    // Preparando a configuração
    @if(is_array($comments) && count($comments) > 0)
        // Criar array com os comentários do backend
        @foreach($comments as $index => $videocomment)
            @php
                $author = $authorNames[array_rand($authorNames)];
                $initial = strtoupper($author[0]);
                $backgroundColor = $getRandomColor();
                // Formato o nome do autor removendo espaços e substituindo por underscores
                $authorFormatted = str_replace(' ', '_', $author);
            @endphp
            
            instagramComments.push({
                author: '{{ $author }}',
                authorFormatted: '{{ $authorFormatted }}',
                initial: '{{ $initial }}',
                backgroundColor: '{{ $backgroundColor }}',
                comment: '{{ $videocomment['message'] ?? ($videocomment['comment'] ?? "Ótima live!") }}',
                index: {{ $index }}
            });
        @endforeach
        
        // Calcular o intervalo de tempo entre comentários com base na duração do vídeo
        @if(isset($commentfrequeny) && $commentfrequeny)
            // Usa a frequência definida na página de gerenciamento de comentários
            const totalDuration = {{ $commentfrequeny->vsl_time_in_minutes ?? 60 }} * 60 * 1000; // Converter minutos para milissegundos
            const totalComments = instagramComments.length;
            
            // Calcula o intervalo base entre comentários
            let commentInterval = Math.floor(totalDuration / (totalComments + 2)); // +2 para compensar os 2 primeiros comentários
            
            // Garante um intervalo razoável (entre 2s e 30s)
            commentInterval = Math.max(2000, Math.min(commentInterval, 30000));
            
            console.log('[DEBUG] vsl_time_in_minutes:', {{ $commentfrequeny->vsl_time_in_minutes ?? 60 }});
            console.log('[DEBUG] Total duration (ms):', totalDuration);
            console.log('[DEBUG] Total comments:', totalComments);
            console.log('[DEBUG] Base interval (ms):', commentInterval);
            
            // Inicia a exibição de comentários
            startCommentDisplay(commentInterval, totalDuration);
        @else
            // Usa um intervalo padrão se não houver frequência definida
            console.log('[DEBUG] Usando intervalo padrão de 15 segundos');
            startCommentDisplay(15000, 15000 * instagramComments.length); // Intervalo padrão
        @endif
    @elseif(is_object($comments) && method_exists($comments, 'isEmpty') && !$comments->isEmpty())
        // Código para lidar com objetos de coleção (Collection)
        @foreach($comments as $index => $videocomment)
            @php
                $author = $authorNames[array_rand($authorNames)];
                $initial = strtoupper($author[0]);
                $backgroundColor = $getRandomColor();
                // Formato o nome do autor removendo espaços e substituindo por underscores
                $authorFormatted = str_replace(' ', '_', $author);
            @endphp
            
            instagramComments.push({
                author: '{{ $author }}',
                authorFormatted: '{{ $authorFormatted }}',
                initial: '{{ $initial }}',
                backgroundColor: '{{ $backgroundColor }}',
                comment: '{{ $videocomment->comment }}',
                index: {{ $index }}
            });
        @endforeach
        
        // Calcular o intervalo de tempo entre comentários com base na duração do vídeo
        @if(isset($commentfrequeny) && $commentfrequeny)
            // Usa a frequência definida na página de gerenciamento de comentários
            const totalDuration = {{ $commentfrequeny->vsl_time_in_minutes ?? 60 }} * 60 * 1000; // Converter minutos para milissegundos
            const totalComments = instagramComments.length;
            
            // Calcula o intervalo base entre comentários
            let commentInterval = Math.floor(totalDuration / (totalComments + 2)); // +2 para compensar os 2 primeiros comentários
            
            // Garante um intervalo razoável (entre 2s e 30s)
            commentInterval = Math.max(2000, Math.min(commentInterval, 30000));
            
            console.log('[DEBUG] vsl_time_in_minutes:', {{ $commentfrequeny->vsl_time_in_minutes ?? 60 }});
            console.log('[DEBUG] Total duration (ms):', totalDuration);
            console.log('[DEBUG] Total comments:', totalComments);
            console.log('[DEBUG] Base interval (ms):', commentInterval);
            
            // Inicia a exibição de comentários
            startCommentDisplay(commentInterval, totalDuration);
        @else
            // Usa um intervalo padrão se não houver frequência definida
            console.log('[DEBUG] Usando intervalo padrão de 15 segundos');
            startCommentDisplay(15000, 15000 * instagramComments.length); // Intervalo padrão
        @endif
    @else
        // Sem comentários para exibir
        console.log('No comments available');
    @endif
}

function startCommentDisplay(interval, totalDuration) {
    // Registrar o tempo de início da exibição
    startDisplayTime = Date.now();
    
    // Remover a mensagem "sem comentários" se existir
    const noCommentElement = document.querySelector('.no-comment');
    if (noCommentElement) {
        noCommentElement.style.display = 'none';
    }
    
    // Limpar qualquer comentário existente para garantir estado inicial limpo
    const commentContainer = document.querySelector('.instagram-comments-container');
    commentContainer.innerHTML = '';
    
    // Mostrar os 2 primeiros comentários imediatamente
    showNextComment();
    
    if (currentCommentIndex < instagramComments.length) {
        setTimeout(function() {
            showNextComment();
            scheduleNextComment(interval, totalDuration);
        }, 1000);
    }
}

// Função para agendar o próximo comentário
function scheduleNextComment(baseInterval, totalDuration) {
    if (currentCommentIndex >= instagramComments.length) {
        console.log('All comments have been displayed');
        return;
    }
    
    // Calcular quanto tempo resta
    const elapsedTime = Date.now() - startDisplayTime; // Tempo decorrido em ms
    const remainingTime = totalDuration - elapsedTime; // Tempo restante em ms
    const remainingComments = instagramComments.length - currentCommentIndex; // Comentários restantes
    
    let nextInterval;
    
    if (remainingComments > 0 && remainingTime > 0) {
        // Recalcular intervalo para garantir que todos os comentários sejam exibidos
        const avgTimePerComment = remainingTime / remainingComments;
        
        // Variação pequena para parecer natural, mas garantindo distribuição completa
        const maxVariation = Math.min(avgTimePerComment * 0.2, 5000); // no máximo 20% de variação ou 5 segundos
        const randomVariation = Math.floor(Math.random() * maxVariation * 2) - maxVariation;
        
        // Garantir um intervalo mínimo de 2 segundos e máximo para distribuição dentro do tempo
        nextInterval = Math.max(2000, Math.min(avgTimePerComment + randomVariation, avgTimePerComment * 1.5));
    } else {
        // Fallback para o intervalo base original
        const randomVariation = Math.floor(Math.random() * (baseInterval * 0.4)) - (baseInterval * 0.2);
        nextInterval = Math.max(5000, baseInterval + randomVariation);
    }
    
    console.log('Next comment in:', nextInterval, 'ms (Remaining time:', remainingTime, 'ms, Remaining comments:', remainingComments, ')');
    
    commentDisplayTimer = setTimeout(function() {
        showNextComment();
        scheduleNextComment(baseInterval, totalDuration);
    }, nextInterval);
}

// Adicionar variável para registrar o tempo de início
let startDisplayTime = null;

function showNextComment() {
    if (currentCommentIndex >= instagramComments.length) {
        console.log('No more comments to display');
        return;
    }
    
    const comment = instagramComments[currentCommentIndex];
    const commentContainer = document.querySelector('.instagram-comments-container');
    
    // Criar o elemento do comentário com classe adicional para altura fixa
    const commentElement = document.createElement('div');
    commentElement.className = 'd-flex flex-row gap-2 animate-comment comment-item';
    
    // IDs únicos para os elementos do avatar
    const avatarId = `avatar-instagram-${comment.index}`;
    const initialId = `initial-instagram-${comment.index}`;
    
    // Criar o HTML com o container de avatar
    commentElement.innerHTML = `
        <div class="d-flex align-items-center me-2">
            <div id="${avatarId}" class="comment-avatar2" style="background-color: ${comment.backgroundColor}">
                <span id="${initialId}" style="display: block;">${comment.initial}</span>
            </div>
        </div>
        <div style="flex: 1;">
            <div class="d-flex flex-column">
                <span style="font-size: 12px; font-weight: 700; color: white; margin-bottom: 2px;">
                    ${comment.author}
                </span>
                <span style="font-size: 0.85rem; color: white; word-break: break-word;">
                    ${comment.comment}
                </span>
            </div>
        </div>
    `;
    
    // Adicionar o comentário ao contêiner
    commentContainer.appendChild(commentElement);
    
    // Verificar se existe foto do avatar no storage
    checkImageExists(comment, avatarId, initialId);
    
    // Limitador de comentários na tela - manter apenas os últimos 6 comentários
    const commentElements = commentContainer.querySelectorAll('.comment-item');
    if (commentElements.length > 6) {
        commentContainer.removeChild(commentElements[0]);
    }
    
    // Usar scrollIntoView com opção block: "nearest" para evitar comentários cortados
    commentElement.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'end' 
    });
    
    // Incrementar o índice para o próximo comentário
    currentCommentIndex++;
}

// Função para verificar se existe uma imagem do avatar
function checkImageExists(comment, avatarId, initialId) {
    // Caminho base para o diretório de avatares
    const avatarBasePath = '{{ asset("storage/avatars/") }}/';
    
    // Fazer a verificação após o DOM estar pronto
    setTimeout(() => {
        const img = new Image();
        img.onload = function() {
            // A imagem existe, configurar o background do avatar
            const avatarElement = document.getElementById(avatarId);
            const initialElement = document.getElementById(initialId);
            
            if (avatarElement && initialElement) {
                avatarElement.style.backgroundImage = `url('${avatarBasePath}${comment.authorFormatted}.jpg')`;
                avatarElement.style.backgroundSize = 'cover';
                initialElement.style.display = 'none';
            }
        };
        
        img.onerror = function() {
            // A imagem não existe, manter o padrão com inicial e cor de fundo
            console.log('Avatar image not found for:', comment.author);
        };
        
        // Tentar carregar a imagem
        img.src = `${avatarBasePath}${comment.authorFormatted}.jpg`;
    }, 50);
}

// Função para corrigir o posicionamento de qualquer iframe de vídeo
function fixVideoPosition() {
    // Espera a renderização do DOM para manipular o iframe
    setTimeout(() => {
        const videoContainer = document.getElementById('instagram-video-container');
        const iframes = videoContainer.querySelectorAll('iframe');
        
        if (iframes.length > 0) {
            iframes.forEach(iframe => {
                // Garante que o iframe preencha o container mas não ultrapasse
                iframe.style.position = 'absolute';
                iframe.style.top = '0';
                iframe.style.left = '0';
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.objectFit = 'cover';
                
                // Fix para dispositivos Android
                if (/Android/i.test(navigator.userAgent)) {
                    iframe.style.width = '100vw';
                    videoContainer.style.width = '100vw';
                    iframe.style.objectPosition = 'center';
                    iframe.style.left = '0';
                    iframe.style.right = '0';
                }
                
                // Adiciona um ouvinte para quando o iframe for carregado
                iframe.addEventListener('load', function() {
                    console.log('Video iframe loaded and positioned');
                    
                    // Executar novamente o ajuste após o carregamento para garantir
                    if (/Android/i.test(navigator.userAgent)) {
                        this.style.width = '100vw';
                        videoContainer.style.width = '100vw';
                        this.style.objectPosition = 'center';
                        this.style.left = '0';
                        this.style.right = '0';
                    }
                });
            });
        }
    }, 500); // Atraso para garantir que o DOM está carregado
    
    // Adiciona um ouvinte para redimensionamento de janela
    window.addEventListener('resize', () => {
        const videoContainer = document.getElementById('instagram-video-container');
        const iframes = videoContainer.querySelectorAll('iframe');
        
        if (iframes.length > 0 && /Android/i.test(navigator.userAgent)) {
            iframes.forEach(iframe => {
                iframe.style.width = '100vw';
                videoContainer.style.width = '100vw';
                iframe.style.objectPosition = 'center';
                iframe.style.left = '0';
                iframe.style.right = '0';
            });
        }
    });
}
</script>
