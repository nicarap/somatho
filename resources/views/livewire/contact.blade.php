<form wire:submit="submit" class="container mx-auto">
    @csrf
    <div class="relative flex flex-col min-w-0 break-words w-full shadow-lg md:rounded-lg bg-primary-500">
        <div class="flex-auto p-5 lg:p-10">
            <h4 class="text-2xl text-gray-100 font-semibold">Vous souhaitez prendre un rendez-vous ?</h4>
            <p class="leading-relaxed mt-1 mb-4 text-gray-100">
                Complétez ce formulaire.
            </p>
            <div class="relative w-full mb-3 mt-6">
                <label class="block uppercase text-gray-100 text-xs font-bold mb-2" for="full-name">Nom &
                    Prénom</label>
                <input wire:model="name" type="text" required
                       class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                       placeholder="Nom & Prénom" style="transition: all 0.15s ease 0s;" />
            </div>
            <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-100 text-xs font-bold mb-2" for="email">Email</label>
                <input wire:model="email" type="email" required
                       class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                       placeholder="Email" style="transition: all 0.15s ease 0s;" />
            </div>
            <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-100 text-xs font-bold mb-2" for="email">Téléphone</label>
                <input wire:model="tel" type="tel" autocomplete required
                       class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                       placeholder="Tel" style="transition: all 0.15s ease 0s;" />
            </div>

            <div class="relative w-full">
                <div class="mb-2">
                    <label class="block uppercase text-gray-100 text-xs font-bold" for="message">Message /
                        Demande de rendez-vous</label>
                    <span class="text-xs text-gray-100">
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
                <textarea wire:model="message" rows="4" cols="80" required
                          class="border-0 px-3 py-3 placeholder-gray-400 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                          placeholder="Ex: Douleur au dos, accident de moto, Séparation, Enceinte..."></textarea>
            </div>
            <span class="text-xs leading-relaxed text-gray-100">Tous les champs sont obligatoire.</span>

            <div class="text-center mt-6">
                <button type="submit" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}" data-callback='handle'
                        data-action='submit'
                        class="g-recaptcha bg-primary-900 text-gray-200 active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                    <div class="flex gap-2 items-center">
                        <svg wire:loading="submit" xmlns="http://www.w3.org/2000/svg" class="fill-white animate-spin"
                             height="16" width="16" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path
                                  d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" />
                        </svg> J'envoi mon message
                    </div>
                </button>
            </div>

            @if ($message_sended_successfull)
                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-green-900" height="16" width="16"
                         viewBox="0 0 512 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path
                              d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                    </svg>

                    <span class="text-xl leading-relaxed text-green-900">Votre message à été envoyé avec
                        succès.</span>
                </div>
            @endif

            @if ($message_sended_error)
                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-red-500" height="16" width="16"
                         viewBox="0 0 512 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path
                              d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>

                    <span class="text-xl leading-relaxed text-red-500">Votre message n'a pas pu être
                        envoyé.</span>
                </div>
            @endif

            @if ($message_captcha_error)
                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-red-500" height="16" width="16"
                         viewBox="0 0 512 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path
                              d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>

                    <span class="text-xl leading-relaxed text-red-500">Google pense que vous êtes un robot.
                        Veuillez
                        rééssayer</span>
                </div>
            @endif
            
            <div class="mt-4">
                <p class="leading-relaxed mt-1 mb-4 text-gray-100 text-xl">
                    Ou contactes moi directement
                </p>
                <div class="mt-2 w-full grid grid-cols-2 sm:grid-cols-3 gap-2 items-center">
                    <a title="BonziSomato" href="{{ config('app.social_medias.facebook') }}" target="_blank"
                       class="flex text-gray-200 fill-gray-200 bg-primary-900 hover:text-primary-900 hover:fill-primary-900 hover:bg-gray-200 shadow-lg font-normal h-8 gap-2 px-2 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-1"
                       type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 320 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                  d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                        </svg>
                        <span class="text-md leading-relaxed">BonziSomato</span>
                    </a>
                    <a title="abonzisomato" href="{{ config('app.social_medias.instagram') }}" target="_blank"
                       class="flex text-gray-200 fill-gray-200 bg-primary-900 hover:text-primary-900 hover:fill-primary-900 hover:bg-gray-200 shadow-lg font-normal h-8 gap-2 px-2 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-1"
                       type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                  d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                        </svg>
                        <span class="text-md leading-relaxed">abonzisomato</span>
                    </a>
                    <a title="{{ env('PHONE_NUMBER') }}" href="{{ config('app.social_medias.whatapps') }}"
                       target="_blank"
                       class="flex text-gray-200 fill-gray-200 bg-primary-900 hover:text-primary-900 hover:fill-primary-900 hover:bg-gray-200 shadow-lg font-normal h-8 gap-2 px-2 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2 p-1"
                       type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                  d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                        </svg>
                        <span class="text-md leading-relaxed">{{ env('PHONE_NUMBER') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- <script src="https://www.google.com/recaptcha/api.js?render={{ env('CAPTCHA_SITE_KEY') }}"></script>
<script>
    function handle(e) {
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('CAPTCHA_SITE_KEY') }}', {
                    action: 'submit'
                })
                .then(function(token) {
                    @this.set('captcha', token);
                });
        })
    }
</script> -->
