<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CyberRisk;

class CyberRiskSeeder extends Seeder
{
    public function run(): void
    {
        $risks = [
            [
                'code' => 'R1',
                'title' => 'Plain-Text Passwords',
                'risk_statement' => 'If passwords are stored in plain text, they can be stolen.',
                'cause' => 'Weak database security and poor coding practices often result in storing passwords without encryption.',
                'consequence' => 'Attackers can easily access credentials during a breach, leading to data exposure.',
                'existing_control' => 'A password policy may exist, but it’s not properly enforced.',
                'likelihood' => 4,
                'impact' => 5,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Use salted SHA-256 password hashing and enable multi-factor authentication (MFA) to protect credentials.'
            ],
            [
                'code' => 'R2',
                'title' => 'Reused Passwords',
                'risk_statement' => 'If employees reuse the same password on many systems, attackers can gain access easily.',
                'cause' => 'Lack of awareness about password management and no enforcement of password uniqueness.',
                'consequence' => 'A single compromised password can lead to unauthorized access to multiple systems.',
                'existing_control' => 'A password policy document exists but is not technically enforced.',
                'likelihood' => 4,
                'impact' => 4,
                'score' => 16,
                'residual_level' => 'High',
                'mitigation_plan' => 'Enforce unique passwords per system and implement password managers across the organization.'
            ],
            [
                'code' => 'R3',
                'title' => 'Missing Backups',
                'risk_statement' => 'If data backups are not performed regularly, information may be lost.',
                'cause' => 'Backups are done manually without automation or a defined schedule.',
                'consequence' => 'A cyber incident could permanently delete critical business data.',
                'existing_control' => 'Some manual backups are taken occasionally.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Schedule automatic daily or weekly cloud backups with regular restoration testing.'
            ],
            [
                'code' => 'R4',
                'title' => 'Outdated Antivirus',
                'risk_statement' => 'If antivirus software is not updated, malware can infect company devices.',
                'cause' => 'Expired antivirus licenses and neglect of update management.',
                'consequence' => 'Malware infections could cause system downtime and loss of data.',
                'existing_control' => 'Antivirus software is installed but not monitored or updated.',
                'likelihood' => 4,
                'impact' => 4,
                'score' => 16,
                'residual_level' => 'High',
                'mitigation_plan' => 'Enable automatic antivirus updates and verify scan reports weekly.'
            ],
            [
                'code' => 'R5',
                'title' => 'Phishing Awareness',
                'risk_statement' => 'If staff are not trained on phishing, someone may click a fake email link.',
                'cause' => 'The organization lacks regular cybersecurity-awareness training sessions.',
                'consequence' => 'Employees may unknowingly expose credentials or download malware.',
                'existing_control' => 'Some employees are careful, but there’s no structured training.',
                'likelihood' => 5,
                'impact' => 4,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Conduct quarterly phishing-awareness campaigns and simulate test emails for staff.'
            ],
            [
                'code' => 'R6',
                'title' => 'Unreviewed Access Rights',
                'risk_statement' => 'If access rights are not reviewed, former employees may keep access.',
                'cause' => 'No routine process for reviewing user accounts after staff leave.',
                'consequence' => 'Ex-employees could access confidential systems or data.',
                'existing_control' => 'HR disables accounts manually but not consistently.',
                'likelihood' => 3,
                'impact' => 4,
                'score' => 12,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Perform quarterly user-access reviews and automate account deactivation upon termination.'
            ],
            [
                'code' => 'R7',
                'title' => 'Delayed Patching',
                'risk_statement' => 'If system patches are delayed, hackers may exploit known vulnerabilities.',
                'cause' => 'Absence of a formal patch-management policy or schedule.',
                'consequence' => 'Exploited vulnerabilities may lead to ransomware infections or system breaches.',
                'existing_control' => 'IT applies patches irregularly without documentation.',
                'likelihood' => 4,
                'impact' => 5,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Adopt a monthly patch-management cycle using automated patching tools.'
            ],
            [
                'code' => 'R8',
                'title' => 'Missing HTTPS',
                'risk_statement' => 'If the website lacks HTTPS, data may be intercepted during transmission.',
                'cause' => 'No SSL/TLS certificate installed or maintained.',
                'consequence' => 'Data leakage and reduced customer trust.',
                'existing_control' => 'Basic hosting security is present but inadequate.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Install and renew SSL/TLS certificates annually and force HTTPS redirection.'
            ],
            [
                'code' => 'R9',
                'title' => 'No Firewall',
                'risk_statement' => 'If there is no firewall, attackers may reach internal systems.',
                'cause' => 'Unsecured routers and open network ports.',
                'consequence' => 'Potential intrusion into company networks.',
                'existing_control' => 'Default router firewalls only.',
                'likelihood' => 4,
                'impact' => 5,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Install enterprise-grade firewalls and review rules quarterly.'
            ],
            [
                'code' => 'R10',
                'title' => 'Unencrypted Devices',
                'risk_statement' => 'If laptops or USB drives are unencrypted, data can be stolen if lost.',
                'cause' => 'Lack of an enforced device encryption policy.',
                'consequence' => 'Data breaches or noncompliance with data protection laws.',
                'existing_control' => 'Device passwords are used but without encryption.',
                'likelihood' => 3,
                'impact' => 4,
                'score' => 12,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Implement full-disk encryption for all portable devices and enforce encryption checks.'
            ],
            [
                'code' => 'R11',
                'title' => 'Single-Device Storage',
                'risk_statement' => 'If important data exists only on one device, it can be lost if the device fails.',
                'cause' => 'No shared or centralized storage.',
                'consequence' => 'Business disruption and data loss.',
                'existing_control' => 'Local backups on personal computers.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Use shared or cloud storage for all business data.'
            ],
            [
                'code' => 'R12',
                'title' => 'Missing MFA',
                'risk_statement' => 'If MFA is not enabled, attackers can log in with stolen passwords.',
                'cause' => 'Outdated systems and lack of awareness.',
                'consequence' => 'Unauthorized access to systems.',
                'existing_control' => 'Password complexity rules only.',
                'likelihood' => 4,
                'impact' => 5,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Implement MFA across all high-risk systems and administrative accounts.'
            ],
            [
                'code' => 'R13',
                'title' => 'Weak Vendors',
                'risk_statement' => 'If vendors have weak security, attackers may enter through them.',
                'cause' => 'No vendor-security assessment process.',
                'consequence' => 'Third-party breach leading to data loss.',
                'existing_control' => 'Vendor contracts without security clauses.',
                'likelihood' => 3,
                'impact' => 4,
                'score' => 12,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Conduct vendor security assessments before onboarding and yearly thereafter.'
            ],
            [
                'code' => 'R14',
                'title' => 'No Incident Plan',
                'risk_statement' => 'If no incident-response plan exists, response will be delayed.',
                'cause' => 'Poor planning and lack of testing.',
                'consequence' => 'Extended downtime and reputational harm.',
                'existing_control' => 'Informal IT response approach.',
                'likelihood' => 4,
                'impact' => 5,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Create and test an incident-response plan twice yearly.'
            ],
            [
                'code' => 'R15',
                'title' => 'Uncontrolled Accounting Access',
                'risk_statement' => 'If accounting systems lack access control, internal fraud may occur.',
                'cause' => 'Shared credentials within financial applications.',
                'consequence' => 'Financial losses and audit failures.',
                'existing_control' => 'Manual review by finance manager.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Enforce role-based access controls and maintain transaction logs.'
            ],
            [
                'code' => 'R16',
                'title' => 'Unsecured Email',
                'risk_statement' => 'If customer data is sent via unsecured email, it can leak.',
                'cause' => 'Use of plain-text email for sensitive information.',
                'consequence' => 'Privacy violations and fines.',
                'existing_control' => 'Staff awareness exists but not enforced.',
                'likelihood' => 4,
                'impact' => 4,
                'score' => 16,
                'residual_level' => 'High',
                'mitigation_plan' => 'Use encrypted email systems and secure file-transfer platforms.'
            ],
            [
                'code' => 'R17',
                'title' => 'Misconfigured Cloud',
                'risk_statement' => 'If cloud accounts are misconfigured, data may be publicly exposed.',
                'cause' => 'Weak configuration practices and no security reviews.',
                'consequence' => 'Leakage of confidential information.',
                'existing_control' => 'Default provider configurations.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Conduct regular cloud audits and enforce least-privilege access.'
            ],
            [
                'code' => 'R18',
                'title' => 'Ignored Logs',
                'risk_statement' => 'If security logs are not monitored, attacks may go unnoticed.',
                'cause' => 'No process or tools for reviewing logs.',
                'consequence' => 'Missed detection of breaches or malware.',
                'existing_control' => 'Logs exist but are not reviewed.',
                'likelihood' => 3,
                'impact' => 4,
                'score' => 12,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Implement log-monitoring tools or SIEM with automatic alerts.'
            ],
            [
                'code' => 'R19',
                'title' => 'Default Passwords',
                'risk_statement' => 'If old or default passwords remain active, attackers can gain access.',
                'cause' => 'Weak password lifecycle management.',
                'consequence' => 'Unauthorized access to accounts.',
                'existing_control' => 'Manual password-change reminders.',
                'likelihood' => 4,
                'impact' => 4,
                'score' => 16,
                'residual_level' => 'High',
                'mitigation_plan' => 'Force password changes on first login and disable unused accounts.'
            ],
            [
                'code' => 'R20',
                'title' => 'Personal Devices',
                'risk_statement' => 'If personal devices are used for work, data may leak.',
                'cause' => 'Lack of a BYOD (Bring Your Own Device) policy.',
                'consequence' => 'Company data might be exposed or lost.',
                'existing_control' => 'Informal restrictions.',
                'likelihood' => 4,
                'impact' => 4,
                'score' => 16,
                'residual_level' => 'High',
                'mitigation_plan' => 'Enforce a Mobile Device Management (MDM) policy and enable remote wipe.'
            ],
            [
                'code' => 'R21',
                'title' => 'Weak Wi-Fi',
                'risk_statement' => 'If Wi-Fi networks are open or unencrypted, traffic can be intercepted.',
                'cause' => 'Weak or outdated wireless security protocols.',
                'consequence' => 'Data interception and rogue access.',
                'existing_control' => 'WPA2 encryption on the main network.',
                'likelihood' => 3,
                'impact' => 4,
                'score' => 12,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Upgrade to WPA3 and use separate guest networks.'
            ],
            [
                'code' => 'R22',
                'title' => 'No Accounting Backups',
                'risk_statement' => 'If accounting records lack backup, ransomware may destroy them.',
                'cause' => 'No offsite or automated backup process.',
                'consequence' => 'Financial loss and prolonged business downtime.',
                'existing_control' => 'Manual copies taken occasionally.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Automate daily backups and test data restoration monthly.'
            ],
            [
                'code' => 'R23',
                'title' => 'No Security Awareness Program',
                'risk_statement' => 'If no security-awareness program exists, human error increases.',
                'cause' => 'Management neglects ongoing security education.',
                'consequence' => 'Higher chance of phishing and operational mistakes.',
                'existing_control' => 'Occasional informal IT advice.',
                'likelihood' => 5,
                'impact' => 4,
                'score' => 20,
                'residual_level' => 'High',
                'mitigation_plan' => 'Launch annual cybersecurity training and track staff completion.'
            ],
            [
                'code' => 'R24',
                'title' => 'Open Server Rooms',
                'risk_statement' => 'If servers are in an open room, unauthorized people may access them.',
                'cause' => 'Poor physical-security practices.',
                'consequence' => 'Equipment theft or damage.',
                'existing_control' => 'Basic door locks.',
                'likelihood' => 2,
                'impact' => 4,
                'score' => 8,
                'residual_level' => 'Medium',
                'mitigation_plan' => 'Secure rooms with card access or CCTV monitoring.'
            ],
            [
                'code' => 'R25',
                'title' => 'No Disaster Recovery Plan',
                'risk_statement' => 'If no disaster-recovery plan exists, business may stop for days after an attack.',
                'cause' => 'Lack of business continuity and recovery planning.',
                'consequence' => 'Long downtime and customer loss.',
                'existing_control' => 'Some backups exist but no plan.',
                'likelihood' => 3,
                'impact' => 5,
                'score' => 15,
                'residual_level' => 'High',
                'mitigation_plan' => 'Develop, document, and test a disaster-recovery plan annually.'
            ],
        ];

        foreach ($risks as $risk) {
            CyberRisk::updateOrCreate(['code' => $risk['code']], $risk);
        }
    }
}
