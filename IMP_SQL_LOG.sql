UPDATE abcd_mos_2016
SET type = 'SAP Going Live Support'
WHERE service = 'SAP Going Live Support' OR service = 'SAP On Call Duty' OR service = 'SAP ESRV Change Control Management' OR service = 'SAP CDP On-Site Support'

UPDATE abcd_mos_2016
SET type = 'Software Change Management'
WHERE service = 'SAP Software Change Management' 

UPDATE abcd_mos_2016
SET type = 'Integration Validation'
WHERE service = 'SAP Integration Validation' OR service = 'SAP Integration Validation' OR service = 'SAP Platform Design Support' OR service = 'OBSOLETE SAP S/4HANA Value&Impl Stra.' OR service = 'SAP Technical Feasibility Check'

UPDATE abcd_mos_2016
SET type = 'Planning Workshops for HANA
& S/4HANA'
WHERE service = 'SAP Migration Planning Workshop' OR service = 'SAP Planning the Digital Transformation' OR service = 'SAP IT Planning Service' OR service = 'OBSOLETE SAP Technical Arch & Infrast' OR service = 'SAP ESRV ALM Roadmap' OR service = 'SAP Continuity Management' OR service = 'SAP Analytics and DigBoardroom Des Supp' OR service = 'SAP ESRV IT Planning'


UPDATE abcd_mos_2016
SET type = 'Empowering Services'
WHERE service = 'SAP Empowering Service' OR service = 'SAP ESRV Delivery Management' OR service = 'SAP ESRV SysMon' OR service = 'SAP Empowering Service' OR service = 'SAP ESRV Architecture & Techn. Infra' OR service = 'OBSOLETE SAP Innovation Strategy &RoadM' OR service = 'SAP ESRV Change Control Management' OR service = 'SAP ESRV LT Assessment'


UPDATE abcd_mos_2016
SET type = 'Business Downtime Optimization'
WHERE service = 'SAP ESRV Business Downtime Optimization' OR service = 'SAP Platform Design Support'

UPDATE abcd_mos_2016
SET type = 'HANA & S/4HANA Planning Services'
WHERE service = 'SAP Migration Planning Workshop' OR service = 'SAP IT Planning Service' OR service = 'SAP E2E Empowering Workshop' OR service = 'SAP S/4 HANA Safeguarding'

UPDATE abcd_mos_2016
SET type = 'Integration Validation'
WHERE service = 'SAP Integration Validation' OR service = 'SAP Integration Validation' OR service = 'SAP Platform Design Support' OR service = 'OBSOLETE SAP S/4HANA Value&Impl Stra.'


What are the total number of total number of day by COE notth america

Pipeline
Fix bigs on NewITP - DONE

count SO for sub services - PUT OFF

segreggation for non S/4 and S/4



-----------------------------------------------------------
UPDATE `abcd_mos_2016`
SET type = 'SAP Going Live Support'
WHERE service = 'SAP Going Live Support' OR service = 'SAP On Call Duty'

UPDATE `abcd_mos_2016`
SET type = 'Software Change Management'
WHERE service = 'SAP Software Change Management' OR service = 'SAP ESRV Change Control Management'

UPDATE `abcd_mos_2016`
SET type = 'Empowering Services'
WHERE service = 'SAP Empowering Service' OR service = 'SAP ESRV Delivery Management' OR service = 'SAP ESRV SysMon' OR service = 'SAP Empowering Service' OR service = 'SAP E2E Empowering Workshop'

UPDATE `abcd_mos_2016`
SET type = 'Business Downtime Optimization'
WHERE service = 'SAP ESRV Business Downtime Optimization' OR service = 'SAP Platform Design Support'

UPDATE `abcd_mos_2016`
SET type = 'HANA Planning Workshop'
WHERE service = 'SAP Migration Planning Workshop' OR service = 'SAP IT Planning Service' OR service = 'SAP Planning the Digital Transformation' 

UPDATE `abcd_mos_2016`
SET type = 'Assessment Services'
WHERE service = 'SAP Technical Integration Check' OR service = 'SAP CDP On-Site Support' OR service = 'SAP Technical Integration Check-Extended' OR service = 'SAP Tech Feasibility Check-Upgrade' OR service = 'SAP Technical Feasibility Check' OR service = 'SAP Tech Integration Check-Upgrade' OR service = 'SAP ESRV ALM Roadmap' OR service = 'SAP Upgrade Assessment' OR 'SAP CDP On-Site Support'

UPDATE `abcd_mos_2016`
SET type = 'Custom Code Management'
WHERE service = 'SAP Custom Code Management' OR service = 'SAP ESRV Custom Code Assessment'

UPDATE `abcd_mos_2016`
SET type = 'Integration Validation'
WHERE service = 'SAP Integration Validation'

UPDATE `abcd_mos_2016`
SET type = 'S/4 HANA Safeguarding'
WHERE service = 'SAP S/4 HANA Safeguarding'

UPDATE 'abcd_mos_2016'
SET type = 'Build Design Support'
WHERE service = 'SAP Build Design Support'


----------------------------------------------------------
MO people

Anil Kumar Kunapareddy
Julio Cezar Almeida
Chinmay Garg
Deepika Paturu
Kiran Bose
Parishudh Reddy Marupurolu
Rahul Shetti
Rajendra N
Rakesh Patel
Sriram Bhaskar
Wilson Karunakar Puvvula
Steven Sanchez
Kaushik Bangalore Venkatarama
David Uhr
Quintina Li

IT People

Balakameswara Sarma Sishta
Kishan Vimalachandran
Kaushik Bangalore Venkatarama
Abhishek Anand
Rakesh Patel
David Uhr
Anil Kumar Kunapareddy
Rahul Shetti
Rajendra N



SELECT sum(`jan`+ `feb`+ `mar` + `apr`+ `may`+ `jun`+ `jul`+ `aug`+ `sep`+ `oct`+ `nov`+ `dec`) as USEmp FROM `abcd_mos_2016` WHERE person IN ('Anil Kumar Kunapareddy', 'Julio Cezar Almeida', 'Parishudh Reddy Marupurolu', 'Chinmay Garg', 'Deepika Paturu', 'Kiran Bose', 'Rahul Shetti', 'Rajendra N', 'Rakesh Patel', 'Sriram Bhaskar', 'Wilson Karunakar Puvvula', 'Steven Sanchez', 'Kaushik Bangalore Venkatarama', 'David Uhr', 'Quintina Li', 'Balakameswara Sarma Sishta', 'Kishan Vimalachandran', 'Abhishek Anand')




-----------------------------------------------------------------


MCC NA Deployment Supp HANA/Grueber, Man  - HDR
MCC NA Production Support Weekend/Graf,    - BO Weekend 
CoE Deployment RSLF/ALM NA (108030307)/S  - RDR
CoE Novices – NA/Flietel, Sabine/REN 
ESCA XX Walmart 12/ESC_WAL12   - first 4 ...diff for every cust.
MCC NA Deploym. Supp Run - ES&PE Supp/Ma   - RDR