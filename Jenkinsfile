pipeline {
    //agent any
    agent { docker 'php' }
    parameters {
        string(name: 'PERSON', defaultValue: 'Mr Jenkins', description: 'Who should I say hello to?')
    }

    environment {
       SAUCE_ACCESS = credentials('sauce-lab-dev')
    }

    stages {
        stage('Example') {
            steps {
                echo "Hello ${params.PERSON}"
            }
        }
        stage('Build') {
            steps {
                echo 'Building..'
                sh 'php --version'
                // Run Composer
                sh 'composer install'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            when {
                branch 'master'
                currentBuild.result == 'SUCCESS'
            }
            steps {
                echo 'Deploying....'

                retry(3) {
                    sh './flakey-deploy.sh'
                }

                timeout(time: 3, unit: 'MINUTES') {
                    //sh './slow-process.sh'
                    echo 'Deploying. timeout'
                }
            }
        }
    }

    post {
        always {
            sh 'This will always run'
        }
        success {
            sh 'This will run only if successful'
        }
        failure {
            sh 'This will run only if failed'
        }
        unstable {
            sh 'This will run only if the run was marked as unstable'
        }
        changed {
            sh 'This will run only if the state of the Pipeline has changed')
            sh 'For example, the Pipeline was previously failing but is now successful'
        }
    }
}