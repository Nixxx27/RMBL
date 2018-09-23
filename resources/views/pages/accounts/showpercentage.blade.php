    <?php 
      //if( $account->amount > $account->current_balance )
      if( $account->current_fund > $account->current_balance )
      {
        $color = "#ef5350"; $arrow ="down";
        $percentTitle ="this  account is down by ";
      }else
      {
        $color = "#06d79c";$arrow ="up";
         $percentTitle ="this  account is up by ";
      }
   
        $oldFigure = $account->current_balance;
        $newFigure = $account->current_fund;
        if($newFigure == 0)
            {
             $percentChange = 0;
        }else
        {
            $percentChange = (1 - $oldFigure / $newFigure) * 100;
            $percent= number_format($percentChange,2);
        }
                                                        
    ?>
        @if($percentChange == 0)
              <span style="font-size:11px;font-weight: 600;color:{{$color}}">-</span>

        @else
            <i class="fas fa-level-{{$arrow}}-alt" style="color:{{$color}}" title="{{$percentTitle}} {{number_format(abs($percent),2)}}%"></i>
            <span style="font-size:12px;font-weight: 600;color:{{$color}}"  title="{{$percentTitle}} {{number_format(abs($percent),2)}}%">{{number_format(abs($percent),2)}} %</span>
        @endif