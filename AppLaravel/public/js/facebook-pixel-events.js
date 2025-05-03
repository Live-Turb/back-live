/**
 * Facebook Pixel Events - LiveTurb Integration
 * Este arquivo contém funções para rastrear eventos do Facebook Pixel
 * no sistema LiveTurb.
 */

// Evento de página visualizada (rastreado automaticamente pelo código base)
function trackPageView() {
    if (typeof fbq !== 'undefined') {
        fbq('track', 'PageView');
    }
}

// Evento de registro concluído
function trackCompleteRegistration(options) {
    if (typeof fbq !== 'undefined') {
        fbq('track', 'CompleteRegistration', options || {
            content_name: 'registro-usuario',
            status: true
        });
    }
}

// Evento de início de checkout
function trackInitiateCheckout(options) {
    if (typeof fbq !== 'undefined') {
        fbq('track', 'InitiateCheckout', options || {});
    }
}

// Evento de teste grátis iniciado
function trackStartTrial(options) {
    if (typeof fbq !== 'undefined') {
        fbq('track', 'StartTrial', options || {});
    }
}

// Evento de compra realizada
function trackPurchase(options) {
    if (typeof fbq !== 'undefined') {
        fbq('track', 'Purchase', options || {
            currency: 'BRL'
        });
    }
}

// Detectar automaticamente eventos baseados na URL
(function() {
    // Detectar se estamos em uma página de sucesso de transação
    var currentUrl = window.location.href;
    
    if (currentUrl.includes('success-transaction') || 
        currentUrl.includes('successTransaction') || 
        currentUrl.includes('mercadopago/success')) {
        
        // Obtém os parâmetros da URL
        var urlParams = new URLSearchParams(window.location.search);
        var planName = urlParams.get('plan') || localStorage.getItem('planName') || 'Plano';
        var planValue = parseFloat(urlParams.get('value') || localStorage.getItem('planValue') || '0');
        
        // Se não tivermos os valores nos parâmetros, tentamos inferir pelo URL ou conteúdo da página
        if (!planValue) {
            if (currentUrl.includes('6bc0595a-f99b-45f0-9840-1b223603286d')) {
                planName = 'Iniciante';
                planValue = 97;
            } else if (currentUrl.includes('313892f0-e4e9-4a7b-8927-ddd15f803879')) {
                planName = 'Profissional';
                planValue = 297;
            } else if (currentUrl.includes('4445d507-5a66-4dda-83de-a660878e1274')) {
                planName = 'Empresarial';
                planValue = 597;
            }
        }
        
        // Rastrear o evento de compra
        trackPurchase({
            content_name: planName,
            content_type: 'subscription',
            value: planValue,
            currency: 'BRL'
        });
        
        console.log('Facebook Pixel: Evento Purchase rastreado', {
            content_name: planName,
            content_type: 'subscription',
            value: planValue,
            currency: 'BRL'
        });
    }
    
    // Detectar página de checkout/pagamento
    if (currentUrl.includes('/checkout') || 
        currentUrl.includes('/payment') || 
        currentUrl.includes('createTransaction') || 
        currentUrl.includes('process-transaction')) {
        
        trackInitiateCheckout();
        console.log('Facebook Pixel: Evento InitiateCheckout rastreado');
    }
    
    // Limpar o armazenamento local após o uso
    setTimeout(function() {
        localStorage.removeItem('planName');
        localStorage.removeItem('planValue');
    }, 5000);
})();
