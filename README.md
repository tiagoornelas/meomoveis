# meomoveis
Projeto Meo Móveis

Este é o Projeto do Site-Catálogo da empresa de varejo de móveis Meo Móveis, para visualização dos
clientes e conexão com vendedores via whatsapp através de usuários desktop e mobile.

A parte principal do projeto, entretanto, é o SISMEO que consiste em sistema de gestão comercial
não fiscal para administração da cartela de clientes, recebíveis, cobranças, recebimentos, logística
e estatísticas da empresa.

# =================================================================================================================
# IMPORTANTE: ASSUME UNCHANGED DBH-INC.PHP (PARA EFEITOS DE AMBIENTE DE TESTE)

Para efeitos do uso simultâneo do ambiente local de testes, providenciei que o git assumisse que o arquivo
includes/dbh-inc não fora alterado, de modo que o caminho para o banco de dados no sistema de testes local
seja o MYSQL do LAMP Local e o caminho do banco de dados no gitHub e, por consequencia, no Hostinger, seja o
banco de dados do Hostinger.

Para tal mudança, assim o fiz:

    git update-index --assume-unchanged [<file> ...]

Para realizar essa alteração e voltar a sincronizar o arquivo dbh-inc, o comando é :

    git update-index --no-assume-unchanged [<file> ...]

Documentação:
    --[no-]assume-unchanged
        When this flag is specified, the object names recorded for the paths are not updated. Instead, this option sets/unsets the "assume unchanged" bit for the paths. When the "assume unchanged" bit is on, the user promises not to change the file and allows Git to assume that the working tree file matches what is recorded in the index. If you want to change the working tree file, you need to unset the bit to tell Git. This is sometimes helpful when working with a big project on a filesystem that has very slow lstat(2) system call (e.g. cifs).

        Git will fail (gracefully) in case it needs to modify this file in the index e.g. when merging in a commit; thus, in case the assumed-untracked file is changed upstream, you will need to handle the situation manually.

Para esta solução, usei a referência de Rob Wilkerson em: "https://stackoverflow.com/questions/3319479/can-i-git-commit-a-file-and-ignore-its-content-changes".

