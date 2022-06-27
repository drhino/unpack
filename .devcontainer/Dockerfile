# See here for image contents:
# https://github.com/microsoft/vscode-dev-containers/tree/v0.236.0/containers/ubuntu/.devcontainer/base.Dockerfile

# Choose the VARIANT in: devcontainer.json ; Note that the ARGument MUST be defined.
ARG VARIANT
FROM mcr.microsoft.com/vscode/devcontainers/base:0-${VARIANT}

#
# PHP 7.4(.3)
#
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get -y install --no-install-recommends php7.4 php7.4-zip

#
# PHP 8.0(.20)
#
#RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#    && apt-get -y install --no-install-recommends software-properties-common \
#    && add-apt-repository -y ppa:ondrej/php \
#    && apt-get -y install --no-install-recommends php8.0 php8.0-zip
