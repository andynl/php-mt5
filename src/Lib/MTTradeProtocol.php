<?php


namespace Tarikh\PhpMeta\Lib;


use Tarikh\PhpMeta\Entities\Order;
use function Couchbase\defaultDecoder;

class MTTradeProtocol
{
    private $m_connect; // connection to MT5 server
    /**
     * @param MTConnect $connect - connect to MT5 server
     */
    public function __construct($connect)
    {
        $this->m_connect = $connect;
    }

    /**
     * Set balance
     *
     * @param int            $login user login
     * @param MTEnDealAction $type
     * @param double         $balance
     * @param string         $comment
     * @param int            $ticket
     * @param bool           $margin_check
     *
     * @return MTRetCode
     */
    public function TradeBalance($login, $type, $balance, $comment, &$ticket = null,$margin_check=true)
    {
        //--- send request
        $data = array(MTProtocolConsts::WEB_PARAM_LOGIN   => $login,
            MTProtocolConsts::WEB_PARAM_TYPE    => $type,
            MTProtocolConsts::WEB_PARAM_BALANCE => $balance,
            MTProtocolConsts::WEB_PARAM_COMMENT => $comment,
            MTProtocolConsts::WEB_PARAM_CHECK_MARGIN => $margin_check?"1":"0",
        );
        if(!$this->m_connect->Send(MTProtocolConsts::WEB_CMD_TRADE_BALANCE, $data))
        {
            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'send trade balance failed');
            return MTRetCode::MT_RET_ERR_NETWORK;
        }
        //--- get answer
        if(($answer = $this->m_connect->Read()) == null)
        {
            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'answer trade balance is empty');
            return MTRetCode::MT_RET_ERR_NETWORK;
        }

        //--- parse answer
        $trade_answer = null;
        //---
        if(($error_code = $this->Parse($answer, $trade_answer)) != MTRetCode::MT_RET_OK)
        {

            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'parse trade balance failed: [' . $error_code . ']' . MTRetCode::GetError($error_code));
            return $error_code;
        }

        //---
        $ticket = $trade_answer->Ticket;
        //---
        return MTRetCode::MT_RET_OK;
    }

    /**
     * check answer from MetaTrader 5 server
     *
     * @param string         $answer - answer from server
     * @param  MTTradeAnswer $trade_answer
     *
     * @return MTRetCode
     */
    private function Parse(&$answer, &$trade_answer)
    {

        $pos = 1;
        //--- get command answer
        $command_real = $this->m_connect->GetCommand($answer, $pos);
        if($command_real != MTProtocolConsts::WEB_CMD_TRADE_BALANCE) return MTRetCode::MT_RET_ERR_DATA;
        //---
        $trade_answer = new MTTradeAnswer();
        //--- get param
        $pos_end = -1;
        $pos_end = -1;
        while(($param = $this->m_connect->GetNextParam($answer, $pos, $pos_end)) != null)
        {
            switch($param['name'])
            {
                case MTProtocolConsts::WEB_PARAM_RETCODE:
                    $trade_answer->RetCode = $param['value'];
                    break;
                case MTProtocolConsts::WEB_PARAM_TICKET:
                    $trade_answer->Ticket = $param['value'];
                    break;
            }
        }

        //--- check ret code
        if(($ret_code = MTConnect::GetRetCode($trade_answer->RetCode)) != MTRetCode::MT_RET_OK) return $ret_code;
        //---
        return MTRetCode::MT_RET_OK;
    }

    public function NewOrder()
    {
        //--- send request
        $data = [
            'SourceLogin' => 1004,
            'Login' => 2132650062,
            'Symbol' => "AUDJPY'",
            'Type' => 0,
            'Volume' => 100,
            'PriceOrder' => 91.975,
            'TypeFill' => 0,
            'Action' => 200,
            'Digits' => 3
        ];

        if(!$this->m_connect->Send(MTProtocolConsts::WEB_CMD_DEALER_SEND, $data))
        {
            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'send trade failed');
            return MTRetCode::MT_RET_ERR_NETWORK;
        }
        //--- get answer
        if(($answer = $this->m_connect->Read()) == null)
        {
            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'answer trade is empty');
            return MTRetCode::MT_RET_ERR_NETWORK;
        }

        //--- parse answer
        $trade_answer = null;
        var_dump($answer); die();
        //---
        if(($error_code = $this->Parse($answer, $trade_answer)) != MTRetCode::MT_RET_OK)
        {

            if(MTLogger::getIsWriteLog()) MTLogger::write(MTLoggerType::ERROR, 'parse trade failed: [' . $error_code . ']' . MTRetCode::GetError($error_code));
            return $error_code;
        }

        //---

        //---
        return MTRetCode::MT_RET_OK;
    }
}

/**
 * get trade answer
 */
class MTTradeAnswer
{
    public $RetCode = '0';
    public $Ticket = 0;
}
