<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function image_definer($id_division){
  $id_division = (int) $id_division;

  switch($id_division){
    case 1: return 'program.jpg'; break;
    case 2: return 'pid.jpg'; break;
    case 3: return 'ga.jpg'; break;
    case 4: return 'medicomm.jpg'; break;
    case 5: return 'creative.jpg'; break;
    case 6: return 'it.jpg'; break;
    case 7: return 'marketing.jpg'; break;
    case 8: return 'lo.jpg'; break;
    default: return false;
  }
}