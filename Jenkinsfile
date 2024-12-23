pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "4s-moto-shop:${env.BUILD_NUMBER}"
        CONTAINER_PORT = "8085"
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building the application...'
                sh 'docker run --rm -v $(pwd):/app -w /app php:8.1-apache php -l index.php'
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests...'
                sh 'docker run --rm -v $(pwd):/app -w /app php:8.1-apache phpunit tests'
            }
        }

        stage('Docker Build') {
            steps {
                echo 'Building Docker image...'
                sh '''
                docker build -t $DOCKER_IMAGE .
                docker push $DOCKER_IMAGE
                '''
            }
        }

        stage('Run Container') {
            steps {
                echo 'Running Docker container...'
                sh '''
                docker run -d -p $CONTAINER_PORT:80 --name 4s-moto-shop $DOCKER_IMAGE
                '''
            }
        }
    }

    post {
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed! Please check the logs.'
        }
    }
}
