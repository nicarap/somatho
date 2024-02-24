<div>
    <x-slot:main-title>
        <h1
            class="text-3xl px-4 md:text-5xl text-center font-serif font-light leading-relaxed mt-4 mb-4 text-secondary-500">
            Articles sur la Somatopathie et le Bien-Être
        </h1>
    </x-slot:main-title>

    <main class="relative">
        <div class="bottom-auto -top-[69px] left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
            style="height: 70px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <div class="pb-20 relative bg-primary-200">
            <div class="container mx-auto text-center px-4 pt-20 ">

                <div class="flex flex-wrap justify-center text-center">
                    <div class="w-full max-w-7xl px-4">
                        <h2 class="text-4xl font-semibold text-primary-900">Articles</h2>

                        <p class="text-lg leading-relaxed text-justify md:text-center mt-4 mb-4 text-gray-800">
                            Explorez l'ensemble des publications dédiées à la somatopathie.
                            Plongez au cœur de cette thérapie douce, découvrez des conseils précieux pour améliorer
                            votre bien-être physique et émotionnel.
                        </p>
                    </div>
                </div>
            </div>

            <div class="custom-shape-divider-top-1703755415" style="
                    position: absolute;
                    left: 0;
                    top: 100%;
                    width: 100%;
                    overflow: hidden;
                    line-height: 0;
                    ">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none" class="fill-primary-200">
                    <path
                        d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                        opacity=".25" class="shape-fill"></path>
                    <path
                        d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                        opacity=".5" class="shape-fill"></path>
                    <path
                        d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </div>
        <div class="bg-gray-200">
            <div class="container mx-auto py-12 px-4  relative z-20">
                <livewire:components.articles></livewire:components.articles>
            </div>
        </div>
    </main>
</div>

@script
    <script>
        window.axeptioSettings = {
            clientId: "65d98de24de9dba969c6ae44",
            cookiesVersion: "bonzi somato-fr-EU",
            googleConsentMode: {
                default: {
                    analytics_storage: "denied",
                    ad_storage: "denied",
                    ad_user_data: "denied",
                    ad_personalization: "denied",
                    wait_for_update: 500
                }
            }
        };

        (function(d, s) {
            var t = d.getElementsByTagName(s)[0],
                e = d.createElement(s);
            e.async = true;
            e.src = "//static.axept.io/sdk.js";
            t.parentNode.insertBefore(e, t);
        })(document, "script");
    </script>
@endscript