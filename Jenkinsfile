pipeline {
    //agent any
    agent { docker 'php' }
    parameters {
        string(name: 'PERSON', defaultValue: 'Mr Jenkins', description: 'Who should I say hello to?')
    }

    //environment {
       //SAUCE_ACCESS = credentials('sauce-lab-dev')
    //}

    stages {
        stage('Example') {
            steps {
                echo "Hello ${params.PERSON}"
            }
        }
        
    }

    post {
        always {
            sh 'This will always run'
            //deleteDir() /* clean up our workspace */
        }
        success {
            sh 'This will run only if successful'
        }
        failure {
            sh 'This will run only if failed'
            mail to: 'moukafih@live.nl',
                         subject: "Failed Pipeline: ${currentBuild.fullDisplayName}",
                         body: "Something is wrong with ${env.BUILD_URL}"
        }
        unstable {
            sh 'This will run only if the run was marked as unstable'
        }
        changed {
            sh 'This will run only if the state of the Pipeline has changed'
            sh 'For example, the Pipeline was previously failing but is now successful'
        }
    }
}