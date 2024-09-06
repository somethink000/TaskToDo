# Set the base image
FROM node:20

# Set working directory
WORKDIR /var/www/laravel/current

# Copy `package.json` and `package-lock.json`
COPY package*.json ./

# Install project dependencies
RUN npm install


RUN npm run build

# Copy project files into the docker image
COPY . .

# Expose the port Vite runs on
EXPOSE 3000

# Start the Vite server
CMD ["npm", "run", "dev"]