FROM node:alpine

# Create a directory where our app will be placed
RUN mkdir -p /usr/src/app

# Change directory so that our commands run inside this new directory
WORKDIR /usr/src/app

# Prevent the reinstallation of node modules at every changes in the source code
COPY package.json yarn.lock /usr/src/app/

# Install all dependencies
RUN yarn install

# Get all the code needed to run the app
COPY . /usr/src/app/

# Serve the app
CMD ["yarn", "dev"]
