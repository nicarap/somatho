/**
 * SEO Enhancement Script - Améliore l'expérience utilisateur et le référencement
 * Pour le site de Somatopathie d'Amelie Bonzi à Tahiti
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Optimisation des images pour les lecteurs d'écran
    optimizeImagesForAccessibility();
    
    // 2. Ajout d'attributs de tracking pour mesurer l'engagement
    setupLinkTracking();
    
    // 3. Création d'un popup de prise de contact non-intrusif
    setupContactPopup();
    
    // 4. Amélioration des liens externes (sécurité et SEO)
    enhanceExternalLinks();
    
    // 5. Mise en évidence des mots-clés dans le contenu
    highlightKeywords();
    
    // 6. Mesure du temps passé sur la page (signal d'engagement positif pour Google)
    trackTimeOnPage();
});

/**
 * Optimise les images du site pour l'accessibilité et le SEO
 */
function optimizeImagesForAccessibility() {
    const images = document.querySelectorAll('img:not([alt])');
    images.forEach(img => {
        // Extraction du nom de fichier pour créer un alt par défaut si nécessaire
        const fileName = img.src.split('/').pop().split('.')[0]
            .replace(/-/g, ' ')
            .replace(/([A-Z])/g, ' $1')
            .replace(/^\w/, c => c.toUpperCase());
        
        img.alt = fileName || 'Image somatopathie Tahiti';
        
        // Ajout de lazy loading pour améliorer les performances
        if (!img.hasAttribute('loading')) {
            img.setAttribute('loading', 'lazy');
        }
    });
}

/**
 * Configure le suivi des clics sur les liens pour mesurer l'engagement
 */
function setupLinkTracking() {
    // Catégoriser les liens par type pour analyse ultérieure
    const internalLinks = document.querySelectorAll('a[href^="/"]:not([data-tracking]), a[href^="' + window.location.origin + '"]:not([data-tracking])');
    const externalLinks = document.querySelectorAll('a[href^="http"]:not([data-tracking])');
    const contactLinks = document.querySelectorAll('a[href*="contact"], a[href*="rendez-vous"], a[href*="consultation"], a[href^="tel:"], a[href^="mailto:"]');
    
    internalLinks.forEach(link => {
        link.setAttribute('data-tracking', 'internal-link');
    });
    
    externalLinks.forEach(link => {
        link.setAttribute('data-tracking', 'external-link');
    });
    
    contactLinks.forEach(link => {
        link.setAttribute('data-tracking', 'contact-action');
    });
    
    // Ajouter des événements pour suivre les clics (à connecter à votre outil d'analyse)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[data-tracking]');
        if (link) {
            const trackingType = link.getAttribute('data-tracking');
            // Si vous utilisez Google Analytics ou autre outil, envoyez l'événement ici
            console.log('Link clicked:', trackingType, link.href);
        }
    });
}

/**
 * Configure un popup de prise de contact non-intrusif après un certain temps
 */
function setupContactPopup() {
    // Récupérer la référence du popup existant
    const contactPopup = document.getElementById('contactPopup');
    if (!contactPopup) return; // S'assurer que le composant existe
    
    // Configurer le bouton de fermeture
    const closeButton = document.getElementById('closeContactPopup');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            contactPopup.classList.add('hidden');
            // Stocker le timestamp actuel quand l'utilisateur ferme le popup
            sessionStorage.setItem('popupShown', JSON.stringify({
                shown: true,
                timestamp: Date.now()
            }));
        });
    }
    
    // Vérifier si le popup a été affiché et quand
    const popupData = sessionStorage.getItem('popupShown');
    let shouldShowPopup = true;
    
    if (popupData) {
        try {
            const data = JSON.parse(popupData);
            const now = Date.now();
            // Délai de 24 heures (en millisecondes) avant de réafficher le popup
            const resetDelay = 24 * 60 * 60 * 1000; 
            
            // Vérifier si moins de 24h se sont écoulées depuis la dernière fermeture
            if (data.shown && (now - data.timestamp) < resetDelay) {
                shouldShowPopup = false;
            }
        } catch (e) {
            // Si erreur de parsing, on réinitialise
            sessionStorage.removeItem('popupShown');
        }
    }
    console.log("shouldShowPopup", shouldShowPopup)
    // Si le popup ne doit pas être affiché, on s'arrête là
    if (!shouldShowPopup) return;
    
    // Attendre que l'utilisateur ait passé du temps sur la page et scrollé
    setTimeout(() => {
        const hasScrolled = window.scrollY > window.innerHeight * 0.3;
        if (hasScrolled) {
            // Afficher le popup
            contactPopup.classList.remove('hidden');
            // Enregistrer dans sessionStorage avec timestamp
            sessionStorage.setItem('popupShown', JSON.stringify({
                shown: true,
                timestamp: Date.now()
            }));
        }
    }, 10000); // 45 secondes
}

/**
 * Améliore les liens externes pour la sécurité et le SEO
 */
function enhanceExternalLinks() {
    const externalLinks = document.querySelectorAll('a[href^="http"]:not([href*="' + window.location.hostname + '"])');
    
    externalLinks.forEach(link => {
        // Sécurité: empêcher la page cible d'accéder à window.opener
        if (!link.getAttribute('rel')) {
            link.setAttribute('rel', 'noopener noreferrer');
        }
        
        // Ouvrir dans un nouvel onglet s'il n'a pas d'attribut target
        if (!link.getAttribute('target')) {
            link.setAttribute('target', '_blank');
        }
        
        // Ajouter un titre si absent pour améliorer l'accessibilité
        if (!link.getAttribute('title')) {
            link.setAttribute('title', link.textContent + ' (s\'ouvre dans un nouvel onglet)');
        }
    });
}

/**
 * Met en évidence les mots-clés importants dans le contenu pour améliorer le SEO
 */
function highlightKeywords() {
    const keywords = [
        'somatopathie', 'thérapie manuelle', 'douleurs', 'bien-être', 
        'Méthode Poyet', 'Tahiti', 'thérapie douce', 'équilibre', 
        'consultation', 'somatopathique', 'troubles émotionnels', 'douleurs chroniques',
        'douleurs physiques', 'stress', 'anxiété', 'corps-esprit', 'tensions',
        'sommeil', 'migraines', 'digestion', 'traitement naturel'
    ];
    
    // Parcourir tous les paragraphes pour y mettre en évidence les mots-clés
    const paragraphs = document.querySelectorAll('p:not([class*="keywords-processed"])');
    
    paragraphs.forEach(paragraph => {
        // Éviter de traiter les paragraphes déjà traités
        paragraph.classList.add('keywords-processed');
        
        // Compter le nombre de mots en gras (strong) déjà présents dans le paragraphe
        const existingStrongs = paragraph.querySelectorAll('strong, b').length;
        
        // Si le paragraphe contient déjà 3 mots en gras ou plus, ne rien faire
        if (existingStrongs >= 3) return;
        
        // Calculer combien de mots-clés nous pouvons encore ajouter (maximum 3 au total)
        const maxNewKeywords = 3 - existingStrongs;
        if (maxNewKeywords <= 0) return;
        
        let content = paragraph.innerHTML;
        let highlightCount = 0;
        
        // Créer un DOM temporaire pour analyser la structure
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;
        
        // Parcourir les nœuds de texte du paragraphe
        const textNodes = [];
        const walkTree = (node) => {
            if (node.nodeType === Node.TEXT_NODE) {
                if (node.textContent.trim() !== '') {
                    textNodes.push(node);
                }
            } else {
                // Ne pas rechercher dans les nœuds qui sont déjà mis en évidence
                if (node.nodeName !== 'STRONG' && node.nodeName !== 'B' && node.nodeName !== 'EM' && node.nodeName !== 'I') {
                    for (let i = 0; i < node.childNodes.length; i++) {
                        walkTree(node.childNodes[i]);
                    }
                }
            }
        };
        
        walkTree(tempDiv);
        
        // Pour chaque mot-clé, chercher dans les nœuds texte
        for (const keyword of keywords) {
            if (highlightCount >= maxNewKeywords) break;
            
            // Rechercher le mot-clé en respectant la casse des mots
            const regex = new RegExp('\\b(' + keyword + ')\\b', 'i');
            
            // Parcourir les nœuds texte pour trouver le mot-clé
            for (let i = 0; i < textNodes.length; i++) {
                if (highlightCount >= maxNewKeywords) break;
                
                const node = textNodes[i];
                if (regex.test(node.textContent)) {
                    // Remplacer seulement dans ce nœud texte
                    node.textContent = node.textContent.replace(
                        regex, 
                        '<strong class="font-bold">$1</strong>'
                    );
                    
                    // Mettre à jour le contenu avec le nœud modifié
                    const parent = node.parentNode;
                    const fragment = document.createRange().createContextualFragment(node.textContent);
                    parent.replaceChild(fragment, node);
                    
                    // Mettre à jour la liste des nœuds texte après modification
                    textNodes.splice(i, 1);
                    i--;
                    
                    highlightCount++;
                }
            }
        }
        
        // Mettre à jour le contenu HTML complet
        if (highlightCount > 0) {
            paragraph.innerHTML = tempDiv.innerHTML;
        }
    });
    
    // Vérifier les paragraphes ayant trop de mots en gras (plus de 3) et en supprimer l'excédent
    document.querySelectorAll('p').forEach(paragraph => {
        const strongs = paragraph.querySelectorAll('strong, b');
        if (strongs.length > 3) {
            // Conserver uniquement les 3 premiers mots en gras
            for (let i = 3; i < strongs.length; i++) {
                const strongElement = strongs[i];
                const textContent = strongElement.textContent;
                const textNode = document.createTextNode(textContent);
                strongElement.parentNode.replaceChild(textNode, strongElement);
            }
        }
    });
}

/**
 * Suit le temps passé sur la page (signal positif pour Google)
 */
function trackTimeOnPage() {
    let startTime = Date.now();
    
    // Enregistrer le temps passé quand l'utilisateur quitte la page
    window.addEventListener('beforeunload', function() {
        const timeSpent = Math.round((Date.now() - startTime) / 1000);
        
        // Enregistrer dans localStorage pour analyse ultérieure
        const pagesVisited = JSON.parse(localStorage.getItem('pagesVisited') || '[]');
        pagesVisited.push({
            url: window.location.pathname,
            title: document.title,
            timeSpent: timeSpent,
            date: new Date().toISOString()
        });
        
        // Limiter à 20 entrées pour éviter de trop remplir le stockage
        if (pagesVisited.length > 20) {
            pagesVisited.shift();
        }
        
        localStorage.setItem('pagesVisited', JSON.stringify(pagesVisited));
        
        // Si vous avez un outil d'analyse, envoyez la donnée ici
        console.log('Time spent on page:', timeSpent, 'seconds');
    });
} 