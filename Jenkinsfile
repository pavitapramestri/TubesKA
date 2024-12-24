pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "4s-moto-shop"
        CONTAINER_NAME = "php_container"
        APP_PORT = "8085:80"
        MYSQL_CONTAINER_NAME = "mysql_container"
        MYSQL_IMAGE = "mysql:5.7"
        MYSQL_ROOT_PASSWORD = "root_password"
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