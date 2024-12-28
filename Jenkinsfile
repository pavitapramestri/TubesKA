pipeline {
    agent any

    environment {
        DOCKER_IMAGE = "php:8.1-apache"
        CONTAINER_ID = "dfbbe365e9bf9670e43da2f80c96591f2a82ca0347f4b1afe5702d4e5aceec22"
        APP_PORT = "8086:80"
        MYSQL_CONTAINER_ID = "d17b8a2229a0f93a157f256005d9ef0ff25215d8d34dba534e2278bb02981d87"
        MYSQL_IMAGE = "mysql:5.7"
        MYSQL_ROOT_PASSWORD = "root_password"
        TEAMS_WEBHOOK_URL = "https://telkomuniversityofficial.webhook.office.com/webhookb2/f3552ee4-3656-411d-81fd-eb24c901dbc3@90affe0f-c2a3-4108-bb98-6ceb4e94ef15/IncomingWebhook/b57b13bc1fc3463a9ae0a7e0b4610864/8658f38e-d469-4898-85c1-d9017620fce8/V2BmNGa2yTwD6s4oZ1USNOnWIjw5ikfAi4NvcMuSFmyTg1"
    }

    stages {
        stage('Git Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/pavitapramestri/TubesKA.git'
            }
        }

        stage('Verify PHP Container') {
            steps {
                script {
                    echo 'Verifying PHP container...'
                    def phpContainerName = "4s-moto-shop-php-1-${env.BUILD_ID}"
                    bat "start /B docker run --name ${phpContainerName} -p ${APP_PORT} -d ${DOCKER_IMAGE}"
                    echo "PHP container is now running on port ${APP_PORT} with container name ${phpContainerName}."
                }
            }
        }

        stage('Verify MySQL Container') {
            steps {
                script {
                    echo 'Verifying MySQL container...'
                    def mysqlContainerName = "4s-moto-shop-mysql-1-${env.BUILD_ID}"
                    bat "start /B docker run --name ${mysqlContainerName} -e MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD} -d ${MYSQL_IMAGE}"
                    echo "MySQL container is now running with container name ${mysqlContainerName}."
                }
            }
        }

        stage('Notify Teams') {
            steps {
                script {
                    sendTeamsNotification("Pipeline execution is in progress. Current stage: Notify Teams.")
                }
            }
        }
    }

    post {
        success {
            script {
                sendTeamsNotification("Pipeline execution completed successfully! :tada:")
            }
        }
        failure {
            script {
                sendTeamsNotification("Pipeline execution failed. :x:")
            }
        }
        always {
            script {
                echo 'Cleaning up Docker resources...'
                def phpContainerName = "4s-moto-shop-php-1-${env.BUILD_ID}"
                def mysqlContainerName = "4s-moto-shop-mysql-1-${env.BUILD_ID}"

                bat "docker stop ${phpContainerName} || echo 'PHP container not running'"
                bat "docker rm ${phpContainerName} || echo 'PHP container not found'"
                bat "docker stop ${mysqlContainerName} || echo 'MySQL container not running'"
                bat "docker rm ${mysqlContainerName} || echo 'MySQL container not found'"
            }
        }
    }
}

// Fungsi untuk mengirim notifikasi ke Microsoft Teams
def sendTeamsNotification(String message) {
    def buildUrl = "${env.BUILD_URL}"
    def fullMessage = """
    {
        "text": "${message}\nBuild details: [View Pipeline](${buildUrl})"
    }
    """
    httpRequest(
        httpMode: 'POST',
        url: "${TEAMS_WEBHOOK_URL}",
        contentType: 'APPLICATION_JSON',
        requestBody: fullMessage
    )
}
