pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "4s-moto-shop"
        CONTAINER_NAME = "php_container"
        APP_PORT = "8085:80"
        MYSQL_CONTAINER_NAME = "mysql_container"
        MYSQL_IMAGE = "mysql:5.7"
        MYSQL_ROOT_PASSWORD = "root_password"
        DOCKER_REGISTRY = "docker.io" // Sesuaikan dengan registry yang Anda gunakan
        DOCKER_USERNAME = "pavitapramestri" // Gantilah dengan username DockerHub Anda
        DOCKER_PASSWORD = "dckr_pat_6aVNV474J3obq-gnWC2feZU4Hvw" // Gantilah dengan password atau token DockerHub Anda
    }

    stages {
        stage('Git Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/pavitapramestri/TubesKA.git'
            }
        }

        stage('Pull Required Docker Images') {
            steps {
                script {
                    echo "Pulling required Docker images..."
                    sh """
                        docker pull ${DOCKER_IMAGE}
                        docker pull ${MYSQL_IMAGE}
                    """
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    echo "Building Docker image for the application..."
                    sh """
                        docker build -t ${DOCKER_IMAGE} .
                    """
                }
            }
        }

        stage('Push Docker Image to Registry') {
            steps {
                script {
                    echo "Pushing Docker image to registry..."
                    // Login ke Docker registry (misalnya DockerHub)
                    sh """
                        echo ${DOCKER_PASSWORD} | docker login -u ${DOCKER_USERNAME} --password-stdin
                        docker push ${DOCKER_IMAGE}
                    """
                }
            }
        }

        stage('Run PHP Container') {
            steps {
                script {
                    echo "Running PHP container..."
                    sh """
                        docker run -d --name ${CONTAINER_NAME} -p ${APP_PORT} ${DOCKER_IMAGE}
                    """
                    
                    echo 'Verifying PHP container is running...'
                    sh """
                        docker ps | grep ${CONTAINER_NAME}
                    """
                }
            }
        }

        stage('Run MySQL Container') {
            steps {
                script {
                    echo "Running MySQL container..."
                    sh """
                        docker run -d --name ${MYSQL_CONTAINER_NAME} -e MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD} ${MYSQL_IMAGE}
                    """
                    
                    echo 'Verifying MySQL container is running...'
                    sh """
                        docker ps | grep ${MYSQL_CONTAINER_NAME}
                    """
                }
            }
        }

        stage('Test Application') {
            steps {
                script {
                    echo "Testing application..."
                    sh """
                        curl -I http://localhost:${APP_PORT.split(':')[0]} || echo 'Application not reachable'
                    """
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up Docker resources...'
            sh """
                docker stop ${CONTAINER_NAME} ${MYSQL_CONTAINER_NAME} || echo 'Containers already stopped'
                docker rm ${CONTAINER_NAME} ${MYSQL_CONTAINER_NAME} || echo 'Containers already removed'
            """
        }
    }
}
