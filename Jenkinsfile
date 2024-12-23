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
            stage('Setup PHP Container') {
                steps {
                    script {
                        try {
                            echo "Container ID: 427aaf0f0a3291c953a62b386fb80472da629e9faa41ce790a24fbaac95171aa"
                            echo 'Verifying PHP container is running...'
                        } catch (Exception e) {
                            echo "Error in PHP Container Setup: ${e}"
                        }
                    }
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
    }

    post {
        success {
            echo 'Pipeline completed successfully.'
        }
        failure {
            echo 'Pipeline failed.'
        }
        always {
            echo 'Performing cleanup...'
            sh """
            docker stop 427aaf0f0a3291c953a62b386fb80472da629e9faa41ce790a24fbaac95171aa || true
            docker rm 427aaf0f0a3291c953a62b386fb80472da629e9faa41ce790a24fbaac95171aa || true
            docker stop 4cafadb2382a49543b14f050033857fc8a98a94c6a52481da8f4b11f523ece5d || true
            docker rm 4cafadb2382a49543b14f050033857fc8a98a94c6a52481da8f4b11f523ece5d || true
            """
        }
    }
}