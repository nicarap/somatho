<?php

return [
    "resources" => [
        "calendar" => [
            "label" => ["single" => "Calendrier"]
        ],
        "traitment" => [
            "label" => [
                "single" => "Soin",
                "plural" => "Soins",
            ],
            "actions" => [
                "send_invoice" => [
                    "label" => "Envoyer la facture",
                    "cta" => "Envoyer",
                    "modal" => [
                        "heading" => "Envoyer une facture à :patient",
                        "description" => "Soin en date du :date",
                    ],
                    "notifications" => [
                        "invoice_sended" => [
                            "success" => [
                                "title" => "La demande à été prise en compte",
                                "description" => "La facture sera envoyé automatiquement au patient"
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "user" => [
            "label" => [
                "single" => "Patient",
                "plural" => "Patients",
            ]
        ],
        "review" => [
            "label" => [
                "single" => "Avis",
                "plural" => "Avis",
            ]
        ]
    ],
    "stats" => [
        "nb_weeks_traitments" => "Soins de la semaine",
        "nb_days_traitments" => "Soins de la journée",
    ],
    "attributes" => [
        "patient" => "Patient",
        "programmed_start_at" => "Début de la séance",
        "programmed_end_at" => "fin de la séance",
        "address" => "Adresse",
        "price" => "Prix",
        "discount" => "Réduction",
        "therapist_validated_at" => "Validé par le thérapeute",
        "patient_validated_at" => "Validé par le patient",
        "traitments" => "Soins",
        "name" => "Nom",
        "email" => "Email",
        "password" => "Mot de passe",
        "tel" => "Téléphone",
        "siren" => "SIREN",
        "birthdate" => "Date de naissance",
        "email_verified_at" => "Email vérifié",
        "content" => "Contenu",
        "value" => "Valeur",
        "published_at" => "Date de publication",
        "title" => "Titre",
        "gtp" => "Demander à chatGTP",
        "pinned" => "Epinglé",
        "tags" => "Tags",

    ]
];
