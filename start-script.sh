#!/bin/bash

# Vérification de l'argument (dev ou prod)
if [ $# -eq 0 ]; then
  echo "Erreur : Vous devez spécifier un environnement. Utilisez 'dev' ou 'prod'."
  exit 1
fi

ENVIRONMENT=$1

# Vérification de l'environnement
if [ "$ENVIRONMENT" != "dev" ] && [ "$ENVIRONMENT" != "prod" ]; then
  echo "Erreur : L'argument doit être 'dev' ou 'prod'."
  exit 1
fi

echo "Lancement en environnement : $ENVIRONMENT"

docker-compose -f ./docker/${ENVIRONMENT}/docker-compose.yml up --build -d

exit 0
