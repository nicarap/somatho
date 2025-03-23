<div id="contactPopup" class="fixed bg-white rounded-lg shadow-xl p-4 max-w-sm z-50 border-2 border-primary-500 animate-fade-in hidden" style="bottom: 50px; right: 50px;">
    <div class="flex justify-between items-start">
        <h4 class="text-primary-900 font-bold text-lg">Besoin d'aide?</h4>
        <button class="text-gray-500 cursor-pointer hover:text-gray-800" id="closeContactPopup">×</button>
    </div>
    <p class="text-gray-700 my-2">Vous souffrez de douleurs chroniques? Prenez rendez-vous pour une consultation de somatopathie à Tahiti.</p>
    <a href="tel:{{ env('PHONE_NUMBER') }}" 
       class="block text-center bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded mt-2">
        Contactez-moi au {{ env('PHONE_NUMBER') }}
    </a>
</div> 