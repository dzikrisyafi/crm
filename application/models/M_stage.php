<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stage extends CI_Model
{
	protected $url = 'https://api-crm.karyakoe.id';

	public function createStage($data)
	{
		$request = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:adin="http://3e.pl/ADInterface">
			<soapenv:Header/>
			<soapenv:Body>
				<adin:createData>
					<adin:ModelCRUDRequest>
						<adin:ModelCRUD>
						<adin:serviceType>API-PIPESTAGE-CRT</adin:serviceType>
						<!--Optional:-->
						<adin:DataRow>
							<!--Zero or more repetitions:-->
							<adin:field column="Name">
								<adin:val>[name]</adin:val>
							</adin:field>
							<adin:field column="Description">
								<adin:val>[description]</adin:val>
							</adin:field>
							<adin:field column="XX_SalesTeam_ID">
								<adin:val>[XX_SalesTeam_ID]</adin:val>
							</adin:field>
							<adin:field column="Reference">
								<adin:val>WEB</adin:val>
							</adin:field>
						</adin:DataRow>
						</adin:ModelCRUD>
							<adin:ADLoginRequest>
								<adin:user>[user]</adin:user>
								<adin:pass>[pass]</adin:pass>
								<adin:lang>192</adin:lang>
								<adin:ClientID>[adclient]</adin:ClientID>
								<adin:RoleID>[roleid]</adin:RoleID>
								<adin:OrgID>[orgid]</adin:OrgID>
								<adin:WarehouseID>[whid]</adin:WarehouseID>
							</adin:ADLoginRequest>
					</adin:ModelCRUDRequest>
				</adin:createData>
			</soapenv:Body>
		</soapenv:Envelope>';
		$ch = curl_init();
		req_init($ch, $request, $this->url);
		$xml = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			return 'Invalid Request - Status ' . $httpcode;
		}
		$responseArray = xml_to_array($xml);
		return $responseArray['soapBody']['ns1queryDataResponse']['WindowTabData'];
	}

	public function createPipeline($data)
	{
		$request = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:adin="http://3e.pl/ADInterface">
			<soapenv:Header/>
			<soapenv:Body>
				<adin:createData>
					<adin:ModelCRUDRequest>
						<adin:ModelCRUD>
						<adin:serviceType>API-PIPELINE-CRT</adin:serviceType>
						<!--Optional:-->
						<adin:DataRow>
							<!--Zero or more repetitions:-->
							<adin:field column="DateDoc">
								<adin:val>[expclose]</adin:val>
							</adin:field>
							<adin:field column="Name">
								<adin:val>[opportunity]</adin:val>
							</adin:field>
							<adin:field column="C_BPartner_ID">
								<adin:val>[C_BPartner_ID]</adin:val>
							</adin:field>
							<adin:field column="ExpectedRevenue">
								<adin:val>[exprev]</adin:val>
							</adin:field>
							<adin:field column="ExpectedClosing">
								<adin:val>[expclose]</adin:val>
							</adin:field>
							<adin:field column="Description">
								<adin:val>[description]</adin:val>
							</adin:field>
							<adin:field column="SalesRep_ID">
								<adin:val>[SalesRep_ID]</adin:val>
							</adin:field>
							<adin:field column="XX_SalesTeam_ID">
								<adin:val>[XX_SalesTeam_ID]</adin:val>
							</adin:field>
							<adin:field column="XX_PipelineStage_ID">
								<adin:val>[XX_PipelineStage_ID]</adin:val>
							</adin:field>
							<adin:field column="Priority">
								<adin:val>[priority]</adin:val>
							</adin:field>
							<adin:field column="Reference">
								<adin:val>WEB</adin:val>
							</adin:field>
						</adin:DataRow>
						</adin:ModelCRUD>
							<adin:ADLoginRequest>
								<adin:user>[user]</adin:user>
								<adin:pass>[pass]</adin:pass>
								<adin:lang>192</adin:lang>
								<adin:ClientID>[adclient]</adin:ClientID>
								<adin:RoleID>[roleid]</adin:RoleID>
								<adin:OrgID>[orgid]</adin:OrgID>
								<adin:WarehouseID>[whid]</adin:WarehouseID>
							</adin:ADLoginRequest>
					</adin:ModelCRUDRequest>
				</adin:createData>
			</soapenv:Body>
		</soapenv:Envelope>';
		$ch = curl_init();
		req_init($ch, $request, $this->url);
		$xml = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			return 'Invalid Request - Status ' . $httpcode;
		}
		$responseArray = xml_to_array($xml);
		return $responseArray['soapBody']['ns1queryDataResponse']['WindowTabData'];
	}

	public function changeStage($data)
	{
		$request = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:adin="http://3e.pl/ADInterface">
		<soapenv:Header/>
			<soapenv:Body>
				<adin:updateData>
					<adin:ModelCRUDRequest>
						<adin:ModelCRUD>
						<adin:serviceType>API-PIPELINE-STAGE</adin:serviceType>
						<adin:RecordID>[XX_Pipeline_ID]</adin:RecordID>
						<adin:DataRow>
							<adin:field column="XX_PipelineStage_ID">
								<adin:val>[XX_PipelineStage_ID]</adin:val>
							</adin:field>
							<adin:field column="Reference">
								<adin:val>WEB</adin:val>
							</adin:field>
						</adin:DataRow>
						</adin:ModelCRUD>
						<adin:ADLoginRequest>
						<adin:user>[user]</adin:user>
						<adin:pass>[pass]</adin:pass>
						<adin:lang>192</adin:lang>
						<adin:ClientID>[adclient]</adin:ClientID>
						<adin:RoleID>[roleid]</adin:RoleID>
						<adin:OrgID>[orgid]</adin:OrgID>
						<adin:WarehouseID>[whid]</adin:WarehouseID>
						</adin:ADLoginRequest>
					</adin:ModelCRUDRequest>
				</adin:updateData>
			</soapenv:Body>
		</soapenv:Envelope>';
		$ch = curl_init();
		req_init($ch, $request, $this->url);
		$xml = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			return 'Invalid Request - Status ' . $httpcode;
		}
		$responseArray = xml_to_array($xml);
		return $responseArray['soapBody']['ns1queryDataResponse']['WindowTabData'];
	}

	public function reorderStage($data)
	{
		$request = '
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:adin="http://3e.pl/ADInterface">
		<soapenv:Header/>
			<soapenv:Body>
				<adin:updateData>
					<adin:ModelCRUDRequest>
						<adin:ModelCRUD>
						<adin:serviceType>API-PIPESTAGE-SORT</adin:serviceType>
						<adin:RecordID>[XX_PipelineStage_ID]</adin:RecordID>
						<adin:DataRow>
							<adin:field column="Line">
								<adin:val>[sortno]</adin:val>
							</adin:field>
							<adin:field column="Reference">
								<adin:val>WEB</adin:val>
							</adin:field>
						</adin:DataRow>
						</adin:ModelCRUD>
						<adin:ADLoginRequest>
						<adin:user>[user]</adin:user>
						<adin:pass>[pass]</adin:pass>
						<adin:lang>192</adin:lang>
						<adin:ClientID>[adclient]</adin:ClientID>
						<adin:RoleID>[roleid]</adin:RoleID>
						<adin:OrgID>[orgid]</adin:OrgID>
						<adin:WarehouseID>[whid]</adin:WarehouseID>
						</adin:ADLoginRequest>
					</adin:ModelCRUDRequest>
				</adin:updateData>
			</soapenv:Body>
		</soapenv:Envelope>';
		$ch = curl_init();
		req_init($ch, $request, $this->url);
		$xml = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			return 'Invalid Request - Status ' . $httpcode;
		}
		$responseArray = xml_to_array($xml);
		return $responseArray['soapBody']['ns1queryDataResponse']['WindowTabData'];
	}

	public function getOpportunities()
	{
		$this->db->select('
			opportunity_id as id, 
			mo.stage_id,
			stage, 
			company_name,
			contact_name,
			mc.email as company_email,
			mi.email as individual_email,
			mc.phone as company_phone,
			mi.phone as individual_phone,
			mc.mobile as company_mobile, 
			mi.mobile as individual_mobile, 
			opportunity, 
			revenue, 
			priority_id as priority
		');
		$this->db->from('m_opportunity mo');
		$this->db->join('m_stage ms', 'ms.stage_id=mo.stage_id', 'inner');
		$this->db->join('customer_contact cc', 'cc.id=mo.contact_id', 'inner');
		$this->db->join('m_company mc', 'mc.company_id=cc.company_id', 'left');
		$this->db->join('m_individual mi', 'mi.contact_id=cc.contact_id', 'left');
		$this->db->order_by('order_num', 'asc');
		return $this->db->get();
	}

	public function getOpportunity($id)
	{
		$this->db->select('
			opportunity_id as id,
			opportunity as name,
			revenue,
			id as contact_id,
			company_name,
			contact_name,
			expected_closing,
			mc.email as company_email,
			mi.email as individual_email,
			priority_id,
			mc.phone as company_phone,
			mi.phone as individual_phone,
		');
		$this->db->from('m_opportunity mo');
		$this->db->join('customer_contact cc', 'cc.id=mo.contact_id', 'inner');
		$this->db->join('m_company mc', 'mc.company_id=cc.company_id', 'left');
		$this->db->join('m_individual mi', 'mi.contact_id=cc.contact_id', 'left');
		$this->db->where('opportunity_id', $id);
		return $this->db->get();
	}
}
