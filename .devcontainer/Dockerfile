# See here for image contents:
# https://github.com/microsoft/vscode-dev-containers/tree/v0.236.0/containers/ubuntu/.devcontainer/base.Dockerfile

# Choose the VARIANT in: devcontainer.json ; Note that the ARGument MUST be defined.
ARG VARIANT
FROM mcr.microsoft.com/vscode/devcontainers/base:0-${VARIANT}

# https://www.php.net/downloads
ARG PHP_VERSION="php-8.1.7"
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get -y install --no-install-recommends build-essential pkg-config libxml2-dev libsqlite3-dev zlib1g-dev \
    && wget https://www.php.net/distributions/${PHP_VERSION}.tar.gz \
    && tar -xzvf ${PHP_VERSION}.tar.gz && rm ${PHP_VERSION}.tar.gz && cd ${PHP_VERSION} \
    && ./configure --with-zlib && make install \
    && cd ../ && rm -rf ${PHP_VERSION}
