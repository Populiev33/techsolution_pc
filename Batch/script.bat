@echo off
echo Début de la sauvegarde...

cd C:\xampp\htdocs\techsolutions\bdd
if errorlevel 1 (
    echo Erreur: Impossible d'acceder au dossier bdd
    pause
    exit /b 1
)

echo Sauvegarde de la base de donnees...
c:\xampp\mysql\bin\mysqldump -uroot techsolution > techsolutions.sql
if errorlevel 1 (
    echo Erreur lors du dump MySQL
    pause
    exit /b 1
)

cd C:\xampp\htdocs\techsolutions
echo Ajout des fichiers a Git...
git add . 

echo Creation du commit...
git commit -m "sauvegarde automatique %date% %time%"

echo Envoi vers GitHub...
git push origin master

if errorlevel 1 (
    echo Erreur lors du push Git
    echo Tentative avec la branche main...
    git push origin main
)

echo Sauvegarde terminee!
pause



