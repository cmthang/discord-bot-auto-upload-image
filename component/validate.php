<?php

function validate()
        {
          if ($GLOBALS['webhookApi'] == ''){
              $GLOBALS['webhookApi'] = $GLOBALS['defaultWebhookApi'];
          }
          if($GLOBALS['titleName'] == ''){
              $GLOBALS['titleName'] = $GLOBALS['defaultTitle'];
          }
          if($GLOBALS['botName'] == ''){
              $GLOBALS['botName'] = $GLOBALS['defaultBotName'];
          }
        }

?>