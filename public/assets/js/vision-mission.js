// ========================================
// Vision & Mission Interactive Script
// ========================================

(function() {
    'use strict';

    // Get DOM elements
    const visionBtn = document.getElementById('visionBtn');
    const missionBtn = document.getElementById('missionBtn');
    const visionContent = document.getElementById('visionContent');
    const missionContent = document.getElementById('missionContent');

    // Check if all elements exist
    if (!visionBtn || !missionBtn || !visionContent || !missionContent) {
        console.error('Required DOM elements not found');
        return;
    }

    /**
     * Switch between Vision and Mission content
     * @param {string} target - 'vision' or 'mission'
     */
    function switchContent(target) {
        if (target === 'vision') {
            // Activate Vision
            visionBtn.classList.add('active');
            missionBtn.classList.remove('active');
            
            visionContent.classList.add('active');
            missionContent.classList.remove('active');
        } else if (target === 'mission') {
            // Activate Mission
            missionBtn.classList.add('active');
            visionBtn.classList.remove('active');
            
            missionContent.classList.add('active');
            visionContent.classList.remove('active');
        }
    }

    /**
     * Handle button click event
     * @param {Event} event - Click event
     */
    function handleButtonClick(event) {
        const button = event.currentTarget;
        const target = button.getAttribute('data-target');
        
        // Only switch if not already active
        if (!button.classList.contains('active')) {
            switchContent(target);
        }
    }

    // Attach event listeners
    visionBtn.addEventListener('click', handleButtonClick);
    missionBtn.addEventListener('click', handleButtonClick);

    // Initialize: Show Vision content by default
    switchContent('vision');

    // Add keyboard accessibility
    document.addEventListener('keydown', function(event) {
        // Press '1' for Vision, '2' for Mission
        if (event.key === '1') {
            switchContent('vision');
        } else if (event.key === '2') {
            switchContent('mission');
        }
    });

    console.log('Vision & Mission page initialized successfully');
})();