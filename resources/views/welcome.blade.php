<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Somatopathie</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <!-- Styles -->

</head>

<body class="antialiased">
    <div class="scroll-smooth h-screen overflow-auto">
        <div class="h-screen relative shadow">
            <div class="w-full absolute top-0 h-3/5 background-poyet z-40"></div>
            <!-- <img src="{{ asset('banner.jpg') }}" -->
            <div class="z-50 flex flex-col w-full h-full justify-center items-center relative">
                <div class="flex flex-col gap-8 items-center w-full mt-24">
                    <div class="mx-auto max-w-3xl w-full bg-white shadow-xl">
                        <div class="flex flex-col items-center pt-4 gap-2">
                            <div class="fill-primary aspect-auto" style="width:100px">@include('logo.b')</div>
                            <div class="fill-primary aspect-auto" style="width:200px">@include('logo.name')</div>
                            <div class="fill-primary my-4" style="width:300px">@include('logo.slogan')</div>
                        </div>
                        <div class="grid grid-cols-4">
                            <a href="#anchor_somato">
                                <div class="p-2 text-center cursor-pointer hover:bg-primary/50">
                                    La somatothérapie
                                </div>
                            </a>
                            <a href="#anchor_reasons">
                                <div class="p-2 text-center cursor-pointer hover:bg-primary/50">
                                    Pourquoi ?
                                </div>
                            </a>
                            <a href="#anchor_target">
                                <div class="p-2 text-center cursor-pointer hover:bg-primary/50">
                                    Pour qui ?
                                </div>
                            </a>
                            <a href="#anchor_target">
                                <div class="p-2 text-center cursor-pointer hover:bg-primary/50">
                                    Contact
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="p-2 max-w-7xl">
                        <p class="text-center">Diplômé de l'École Supérieure d'Ostéopathie de Paris, j’exerce sur rendez-vous dans mon cabinet à Nantes.</p>

                        Je travaille avec différents professionnels de santé (médecins généralistes et spécialistes, kinésithérapeutes, chirurgiens dentistes, ophtalmologistes, orthoptistes, podologues, psychologues, sophrologues) afin de vous offrir la meilleure prise en charge.
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex">
            <div class="sticky bg-white shadow-xl top-1 h-screen w-64">
                <div class="flex justify-center pt-4">
                    <div class="fill-primary aspect-auto" style="width:100px">@include('logo.b')</div>
                </div>
                <div class="pt-4">
                    <a href="#anchor_somato">
                        <div class="p-2 cursor-pointer hover:bg-primary/50">
                            La somatothérapie
                        </div>
                    </a>
                    <a href="#anchor_reasons">
                        <div class="p-2 cursor-pointer hover:bg-primary/50">
                            Pourquoi ?
                        </div>
                    </a>
                    <a href="#anchor_target">
                        <div class="p-2 cursor-pointer hover:bg-primary/50">
                            Pour qui ?
                        </div>
                    </a>
                </div>
            </div>
            <div class="grow ">
                <div id="anchor_somato" class="relative min-h-screen bg-dots-darker bg-center  dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                    <x-somatotherapy></x-somatotherapy>
                </div>
                <div id="anchor_reasons" class="relative min-h-screen bg-dots-darker bg-center  dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                    <x-reasons></x-reasons>
                </div>
                <div id="anchor_target" class="relative min-h-screen bg-dots-darker bg-center  dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                    <x-target></x-target>
                </div>
            </div>
        </div>
    </div>
</body>

</html>