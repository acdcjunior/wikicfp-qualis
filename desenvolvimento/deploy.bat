:: @echo off
set /p userpass="Usuario/Senha para deploy via Git-FTP? "
docker run --rm -it mwienk/docker-git-ftp bash -c "git clone https://github.com/acdcjunior/wikicfp-qualis.git . && git ftp push -u u910267182.%userpass% -p %userpass% -P ftp://ftp.wikicfpqualis.esy.es"