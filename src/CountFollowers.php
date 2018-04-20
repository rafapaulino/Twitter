<?php

namespace Twitter;

class CountFollowers
{
	private $_account;
	private $_curl;
	private $_url;

	public function __construct( $account )
	{
		$this->_account = $account;
		$this->_curl = curl_init(); 
		$this->_url = "https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=".$this->_account;
	}

	public function __destruct()
	{
		curl_close($this->_curl);
	}

	public function getTotal()
	{
        curl_setopt($this->_curl, CURLOPT_URL, $this->getUrl()); 
        
        //return the transfer as a string 
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYHOST, 0);
        
        // $output contains the output string 
        $output = curl_exec($this->_curl); 

        // Decoding json response
		$response = json_decode($output, true);


		if ( count($response) > 0 ) {
			$result = $this->returnArrayResult($response);
		} else {
			$result = $this->returnArrayErrorResult($response);
		}

		return $result;
	}

	private function returnArrayErrorResult($result)
	{
		return array(
			'total' => 0,
			'result' => 'error',
			'response' => $result
		);
	}

	private function returnArrayResult($result)
	{
		return array(
			'total' => intval($result[0]['followers_count']),
			'result' => 'success',
			'response' => $result
		);
	}

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->_url;
    }
}