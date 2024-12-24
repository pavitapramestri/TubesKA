pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "4s-moto-shop"                
        DOCKER_REGISTRY = 'https://index.docker.io/v1/'
        DOCKER_REPO = 'pavitapramestri/4s-moto-shop' 
        DOCKER_CREDENTIALS = 'pavitapramestri'      
        PHP_IMAGE = "php:8.1-apache"               
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

        stage('Build Docker Image') {
            steps {
                script {
                    // Build Docker image dari aplikasi
                    docker.build("${DOCKER_IMAGE}:latest", ".")
                }
            }
        }

        stage('Push Docker Image') {
            steps {
                script {
                    // Login ke Docker registry dan push image ke repository
                    docker.withRegistry("${DOCKER_REGISTRY}", "${DOCKER_CREDENTIALS}") {
                        docker.image("${DOCKER_IMAGE}:latest").push()
                    }
                }
            }
        }

        stage('Setup PHP Container') {
            steps {
                script {
                    echo "Menggunakan image PHP: ${PHP_IMAGE}"

                    // Periksa container PHP (misalnya apakah container sudah berjalan)
                    echo 'Memverifikasi container PHP sedang berjalan...'
                    // Tambahkan command docker inspect atau docker ps jika dibutuhkan
                }
            }
        }

        stage('Setup MySQL Container') {
            steps {
                script {
                    echo "Menggunakan image MySQL: ${MYSQL_IMAGE}"

                    // Periksa container MySQL (misalnya apakah container sudah berjalan)
                    echo 'Memverifikasi container MySQL sedang berjalan...'
                    // Tambahkan command docker inspect atau docker ps jika dibutuhkan
                }
            }
        }
    }

    post {
        always {
            script {
                // Bersihkan resource Docker setelah pipeline selesai
                echo 'Membersihkan resource Docker...'
                // Tambahkan command untuk docker container stop atau docker rm jika diperlukan
            }
        }
    }
}
