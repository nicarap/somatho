<form wire:submit="submit" class="container mx-auto px-4">
    <div class="flex flex-wrap justify-center">
        <div class="w-full lg:w-6/12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-primary-500">
                <div class="flex-auto p-5 lg:p-10">
                    <h4 class="text-2xl font-semibold">Vous souhaitez prendre un rendez-vous ?</h4>
                    <p class="leading-relaxed mt-1 mb-4 text-gray-600">
                        Complétez ce formulaire.
                    </p>
                    <div class="relative w-full mb-3 mt-8">
                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="full-name">Nom & Prénom</label>
                        <input wire:model="name" type="text" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Nom & Prénom" style="transition: all 0.15s ease 0s;" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">Email</label>
                        <input wire:model="email" type="email" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Email" style="transition: all 0.15s ease 0s;" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">Téléphone</label>
                        <input wire:model="tel" type="tel" autocomplete class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Tel" style="transition: all 0.15s ease 0s;" />
                    </div>

                    <div class="relative w-full">
                        <div class="mb-2">
                            <label class="block uppercase text-gray-700 text-xs font-bold" for="message">Message / Demande de rendez-vous</label>
                            <span class="text-xs text-gray-700">
                                Veuillez préciser :
                                <ul class="ml-2">
                                    <li>
                                        Pour quel motif souhaitez-vous consulter.
                                    </li>
                                    <li>
                                        Vos disponibilitées.
                                    </li>
                                </ul>
                            </span>
                        </div>
                        <textarea wire:model="message" rows="4" cols="80" class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full" placeholder="Ex: Douleur au dos, accident de moto, Séparation, Enceinte..."></textarea>
                    </div>
                    <span class="text-xs leading-relaxed text-gray-600">Tous les champs sont obligatoire.</span>

                    @if($message_sended_successfull)
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-green-200" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                        </svg>

                        <span class="text-xs leading-relaxed text-green-200">Votre message à été envoyé avec succès.</span>
                    </div>
                    @endif

                    @if($message_sended_error)
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-600" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                        </svg>

                        <span class="text-xs leading-relaxed text-gray-600">Votre message à été envoyé avec succès.</span>
                    </div>
                    @endif

                    <div class="text-center mt-6">
                        <button class="bg-primary-900 text-white active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">
                            <div class="flex gap-2 items-center">
                                <svg wire:loading="submit" xmlns="http://www.w3.org/2000/svg" class="fill-white animate-spin" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" />
                                </svg> J'envoi mon message
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>