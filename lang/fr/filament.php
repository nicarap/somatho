<?php

return [
    "resources" => [
        "calendar" => [
            "label" => ["single" => "Calendrier"]
        ],
        "profile" => [
            "label" => ["single" => "Profile"]
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
        "invoice" => [
            "label" => [
                "single" => "Facture",
                "plural" => "Factures",
            ]
        ],
        "contact" => [
            "label" => [
                "single" => "Contact",
                "plural" => "Contacts",
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
        "programmed_end_at" => "Fin de la séance",
        "address" => "Adresse",
        "price" => "Prix",
        "discount" => "Réduction",
        "realized_at" => "Le soin à été réalisé",
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
        "color" => "Couleur",
        "manual_adress" => "Saisir l'adresse manuellement",
        "invoice_sended" => "Facture envoyée",
        "addresses" => [
            "name" => "Nom de l'adresse",
            "street" => "Rue",
            "context" => "Contexte",
            "postcode" => "Code Postal",
            "city" => "Ville",
            "default" => "Adresse par défaut"
        ],
        "status" => "Statut",
        "manual_address" => "Saisir l'adresse manuellement",
        "note" => "Note",
        "programmed" => "Soin programmé",
        "therapist" => "Thérapeute",
        "invoice_number" => "Numéro de facture",
        "traitment" => "Soin",
        "paid_at" => "Payé le",
        "created_at" => "Crée le",
        "read_at" => "Lu le",
        "read" => "Lu",
        "not_read" => "Non lu",
    ]
];
