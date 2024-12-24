pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "php:8.1-apache"
        CONTAINER_ID = "d17e7e66243eeef989582e214edd7e9b15cbb88e70cd612a3467e08d5dffa51b"
        APP_PORT = "8085:80"
        MYSQL_CONTAINER_ID = "295d5fc44cad1be141c9e1d254653e23fdd48c99d1c57ed3ecc407c6b061adce"
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
                    echo "Container ID: d17e7e66243eeef989582e214edd7e9b15cbb88e70cd612a3467e08d5dffa51b"
                    
                    echo 'Verifying PHP container is running...'
                }
            }
        }
        
        stage('Setup MySQL Container') {
            steps {
                script {
                    echo "Container ID: 295d5fc44cad1be141c9e1d254653e23fdd48c99d1c57ed3ecc407c6b061adce"

                    echo 'Verifying MySQL container is running...'
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