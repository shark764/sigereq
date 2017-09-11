

php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Img" --filter="Ryx" --filter="CtlAreaServicioDiagnostico" --filter="CtlExamenServicioDiagnostico" --filter="CtlEstadoServicioDiagnostico" --filter="MntAreaExamenEstablecimiento" --filter="SecDetallesolicitudestudios" --filter="SecSolicitudestudios" --filter="MntDatoReferencia" --filter="MntExpedienteReferido" --filter="MntPacienteReferido"
php app/console doctrine:generate:entities MinsalSimagdBundle --no-backup
php app/console cache:clear
php app/console cache:clear --env=dev --no-warmup
php app/console cache:clear --env=prod
php app/console cache:clear --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
php app/console assets:install



php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Img" --filter="Ryx" --filter="CtlAreaServicioDiagnostico" --filter="CtlExamenServicioDiagnostico" --filter="CtlEstadoServicioDiagnostico" --filter="MntAreaExamenEstablecimiento" --filter="SecDetallesolicitudestudios" --filter="SecSolicitudestudios" --filter="MntDatoReferencia" --filter="MntExpedienteReferido" --filter="MntPacienteReferido"



https://developer.mozilla.org/en-US/docs/Web/API/SpeechRecognition/onspeechend
https://groups.google.com/a/chromium.org/forum/#!topic/chromium-html5/s2XhT-Y5qAc