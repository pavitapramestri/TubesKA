pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/pavitapramestri/TubesKA.git'
            }
        }
        stage('Send Dockerfile to Ansible') {
            steps {
                echo '....'
            }
        }
        stage('Build Docker Image') {
            steps {
                echo '....'
            }
        }
        stage('Push Image to Docker Hub') {
            steps {
                echo '....'
            }
        }
        stage('Copy Files to Kubernetes') {
            steps {
                echo '....'
            }
        }
        stage('Deploy to Kubernetes') {
            steps {
                echo '...'
            }
        }
    }
}