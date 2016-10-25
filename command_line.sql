git branch
git add --all
git commit -am 'commit plugins'
git pull origin shark
git push origin shark

git branch
git add --all
git commit -am 'commit plugins'
git pull origin versionshark
git push origin versionshark

git branch
git add --all
git commit -am 'commit plugins'
git pull origin farid
git push origin farid


php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Img"
php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Img"
php app/console doctrine:generate:entities MinsalSimagdBundle --no-backup

php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Ryx"
php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Ryx"
php app/console doctrine:generate:entities MinsalSimagdBundle --no-backup




php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Img"
php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Ryx"
php app/console doctrine:mapping:convert xml ./src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Pat"
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Sec*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Ctl*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Ryx*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Img*
php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Ryx"


php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="RyxCtlFormaContacto" --filter="RyxCtlEstado" --filter="RyxExamenPendiente" --filter="RyxEstudioPendiente" --filter="RyxLecturaPendiente" --filter="RyxDiagnosticoPendiente"



php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Img"
php app/console doctrine:mapping:convert xml ./src/Minsal/SimagdBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Ryx"
php app/console doctrine:mapping:convert xml ./src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm --from-database --force --filter="Pat"
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Sec*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Ctl*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Ryx*
rm -rf src/Minsal/PatologiaBundle/Resources/config/doctrine/metadata/orm/Img*

php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Pendiente"
php app/console doctrine:mapping:import MinsalSimagdBundle annotation --filter="Avance"
rm -rf src/Minsal/SimagdBundle/Entity/Img*

