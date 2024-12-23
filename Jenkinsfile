pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "php:8.1-apache"
        CONTAINER_ID = "427aaf0f0a3291c953a62b386fb80472da629e9faa41ce790a24fbaac95171aa"
        APP_PORT = "8085:80"
        MYSQL_CONTAINER_ID = "4cafadb2382a49543b14f050033857fc8a98a94c6a52481da8f4b11f523ece5d"
        MYSQL_IMAGE = "mysql:5.7"
        MYSQL_ROOT_PASSWORD = "root_password"
    }

    stages {
        stage('Git Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/pavitapramestri/TubesKA.git'
            }
        }

        stage('Setup PHP Container') {
            steps {
                script {
                    echo "Container ID: 427aaf0f0a3291c953a62b386fb80472da629e9faa41ce790a24fbaac95171aa"
                    
                    echo 'Verifying PHP container is running...'
                }
            }
        }
        
        stage('Setup MySQL Container') {
            steps {
                script {
                    echo "Container ID: 4cafadb2382a49543b14f050033857fc8a98a94c6a52481da8f4b11f523ece5d"

                    echo 'Verifying MySQL container is running...'
                }
            }
        }

        stage('Connect MySQL Container') {
            steps {
                script {
                    echo 'Running MySQL container...'
                    sh "docker run -d --name 4s-moto-shop-mysql-1 \
                       -e MYSQL_ROOT_PASSWORD=root_password \
                       -e MYSQL_DATABASE=cart_db"
                }
            }
        }
        
    }

    post {
        always {
            echo 'Cleaning up Docker resources...'
        }
    }
}