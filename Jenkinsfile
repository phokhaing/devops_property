pipeline {
    agent any

    stages {
        stage('Git Clone') {
            steps{
                git branch: 'main', 
                credentialsId: 'github_credential', 
                url: 'https://github.com/phokhaing/devops_property.git'
            }
        }
        
        stage('Allow permision dir'){
            steps{
                sh "sudo chmod -R 777 ."
            }
        }
        
        stage('Docker build'){
            steps{
                sh "sed -i \"s/TAG_VERSION/$BUILD_NUMBER/g\" docker-compose.yaml"
                // sh "docker-compose build"
                sh "docker-compose up -d"
            }
        }
        /*
        stage('Push Image to Docker Hub'){
            steps{
                echo "Push phokhaing/devops_property to docker hub"
                withCredentials([string(credentialsId: 'dockerhub_credential', variable: 'dockerhub_pwd')]) {
                    sh 'docker login -u phokhaing -p $dockerhub_pwd'
                }
                sh "docker push phokhaing/devops_property:$BUILD_NUMBER"
                // remove all images
                //sh "docker rmi --force phokhaing/devops_property:$BUILD_NUMBER"
            }
        }
        stage('Deploy on kubernetes cluster'){
            environment {
                ssh_master1 = 'ubuntu@172.20.2.81'
                ssh_master1_dir = 'ubuntu@172.20.2.81:/home/ubuntu'
            }
            steps{
                sshagent(['kube_master1']) {
                    echo "copy deploy files into server kubernetes_master"
                    sh "scp -o StrictHostKeyChecking=no app-deploy.yaml $ssh_master1_dir"
                    // sh "scp -o StrictHostKeyChecking=no mysql-secret.yaml mysql-pvc.yaml mysql-deploy.yaml app-deploy.yaml ubuntu@172.31.16.84:/home/ubuntu"
                    // sh "scp -o StrictHostKeyChecking=no mysql-secret.yaml ubuntu@54.151.164.253:/home/ubuntu"
                    // sh "scp -o StrictHostKeyChecking=no mysql-pvc.yaml ubuntu@54.151.164.253:/home/ubuntu"
                    // sh "scp -o StrictHostKeyChecking=no mysql-deploy.yaml ubuntu@54.151.164.253:/home/ubuntu"
                    
                    echo "use sed to find and replace text TAG_VERSION"
                    sh "ssh $ssh_master1 sed -i \"s/TAG_VERSION/$BUILD_NUMBER/g\" app-deploy.yaml"
                    
                    echo "Deploy Application"
                    script{
                        try{
                            echo "Deploy Database"
                            sh "ssh $ssh_master1 kubectl apply -f app-deploy.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl apply -f mysql-secret.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl apply -f mysql-pvc.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl apply -f mysql-deploy.yaml"
                            // echo "Deploy App"
                            // sh "ssh ubuntu@54.151.164.253 kubectl apply -f app-deploy.yaml"
                            
                        }catch(error){
                            echo "Deploy Database"
                            sh "ssh $ssh_master1 kubectl create -f app-deploy.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl create -f mysql-secret.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl create -f mysql-pvc.yaml"
                            // sh "ssh ubuntu@54.151.164.253 kubectl create -f mysql-deploy.yaml"
                            // echo "Deploy App"
                            // sh "ssh ubuntu@54.151.164.253 kubectl create -f app-deploy.yaml"
                        }
                    }
                }
            }
        }
        */
    }
    
    /*--- Slack notifier ---*/
    post {
        // only triggered when blue or green sign
        success {
            slackSend teamDomain: 'g7devops',
            channel: 'hr-system', 
            tokenCredentialId: 'slack_credential',
            color: 'good',
            message: "Build Started: $JOB_NAME #$BUILD_NUMBER:\nOpen: $BUILD_URL}\nSatus: SUCCESS"
        }
        // triggered when red sign
        failure {
            slackSend teamDomain: 'g7devops',
            channel: 'hr-system', 
            tokenCredentialId: 'slack_credential',
            color: 'danger',
            message: "Build Started: $JOB_NAME #$BUILD_NUMBER}:\nOpen: $BUILD_URL}\nSatus: FAILE"
        }
        // // trigger every-works
        // always {
        //   slackSend ...
        // }
    }
}
