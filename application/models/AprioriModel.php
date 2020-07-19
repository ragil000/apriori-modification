<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AprioriModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function _getApriori($range = 1)
	{
		$arrayData = [
			[
				'tanggal' => '1',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '1',
				'item' => 'Paku'
			],
			[
				'tanggal' => '1',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '2',
				'item' => 'Besi'
			],
			[
				'tanggal' => '2',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '2',
				'item' => 'Semen'
			],
			[
				'tanggal' => '3',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '3',
				'item' => 'Besi'
			],
			[
				'tanggal' => '3',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '4',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '4',
				'item' => 'Besi'
			],
			[
				'tanggal' => '5',
				'item' => 'Besi'
			],
			[
				'tanggal' => '5',
				'item' => 'Paku'
			],
			[
				'tanggal' => '5',
				'item' => 'Semen'
			],
			[
				'tanggal' => '6',
				'item' => 'Besi'
			],
			[
				'tanggal' => '6',
				'item' => 'Paku'
			],
			[
				'tanggal' => '6',
				'item' => 'Semen'
			],
			[
				'tanggal' => '7',
				'item' => 'Besi'
			],
			[
				'tanggal' => '7',
				'item' => 'Paku'
			],
			[
				'tanggal' => '7',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '8',
				'item' => 'Paku'
			],
			[
				'tanggal' => '8',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '8',
				'item' => 'Semen'
			],
			[
				'tanggal' => '9',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '9',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '9',
				'item' => 'Semen'
			],
			[
				'tanggal' => '10',
				'item' => 'Besi'
			],
			[
				'tanggal' => '10',
				'item' => 'Paku'
			],
			[
				'tanggal' => '10',
				'item' => 'Semen'
			],
			[
				'tanggal' => '11',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '11',
				'item' => 'Paku'
			],
			[
				'tanggal' => '11',
				'item' => 'Alkasit'
			],
			[
				'tanggal' => '12',
				'item' => 'Pipa'
			],
			[
				'tanggal' => '12',
				'item' => 'Paku'
			],
			[
				'tanggal' => '12',
				'item' => 'Alkasit'
			],
		];

		$arrayData		= $this->__getData($range);
		$filteredData	= $this->__dataElimination($arrayData);
		$sortirItems 	= $this->__sortirItem($arrayData);
		$aprioriData 	= $this->__supportItem($sortirItems);
		
		return $aprioriData;
	}

	protected function __getData($range = 1)
	{
					  $this->db->join('table_barang tb', 'tb.barang_id=tk.barang_id');
					  $this->db->select('table_keluar.barang_id AD id, tb.barang_nama AS item, tk.keluar_jumlah AS jumlah, tk.keluar_tanggal AS tanggal');
		$results	= $this->db->get('table_keluar tk')->result_array();
		return $results;
	}

	protected function __dataElimination($arrayData) {
		foreach($arrayData as $result) {
			$sum	= $this->__SumQuantityDataById($result['id']);
		}
	}

	protected function __sortirItem($arrayData)
	{
		$sortirItems = array();
		$counItem = array();
		$counGroup = array();
		foreach($arrayData as $result)
		{
			if(!in_array($result['item'], $counItem))
			{
				array_push($counItem, $result['item']);

				$group = array();
				$total = 0;
				foreach($arrayData as $result2)
				{
					if($result['item'] == $result2['item'])
					{
						$total += $result['jumlah'];
						array_push($group, $result2['tanggal']);
					}
				}

				$data = [
					'item' => $result['item'],
					'total' => $total,
					'group' => $group,
					'frequency' => count($group)
				];
				array_push($sortirItems, $data);
			}

			if(!in_array($result['tanggal'], $counGroup))
			{
				array_push($counGroup, $result['tanggal']);
			}
		}
		
		$data = [
			'totalGroup' => count($counGroup)
		];
		array_push($sortirItems, $data);

		return $sortirItems;
	}

	protected function __supportItem($sortirItems)
	{
		$supportItems = array();
		$countItems = count($sortirItems);
		$count = 0;
		foreach($sortirItems as $result)
		{
			$count++;

			if($count != $countItems)
			{
				$support = ($result['frequency']/$sortirItems[$countItems-1]['totalGroup'])*100;
				$data = [
					'item' => $result['item'],
					'total' => $result['total'],
					'group' => $result['group'],
					'frequency' => $result['frequency'],
					'support' => number_format($support, 2)
				];
				array_push($supportItems, $data);
			}else
			{
				break;
			}
		}
		// $data = [
		// 	'totalGroup' => $sortirItems[$countItems-1]['totalGroup'],
		// 	'iterasi' => 1
		// ];
		// array_push($supportItems, $data);

		return $supportItems;
	}

}
