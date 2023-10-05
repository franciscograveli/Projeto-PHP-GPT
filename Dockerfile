# Use a imagem oficial do PHP 7.4 como imagem base
FROM php:7.4-cli

# Atualize os pacotes e instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure o diretório de trabalho para o diretório do aplicativo
WORKDIR /var/www/html

# Copie os arquivos do seu aplicativo para o contêiner
COPY . /var/www/html

# Exponha a porta 80 para tráfego HTTP (não é estritamente necessário neste caso, mas pode ser útil para referência)
EXPOSE 80

# Comando para iniciar o servidor embutido do PHP
CMD ["php", "-S", "0.0.0.0:80"]
