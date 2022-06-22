<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\MessengerComponent;

/**
 * Appointment command.
 */
class AppointmentCommand extends Command
{
    public function initialize() :void {
		$this->MessengerComponent = new MessengerComponent(new ComponentRegistry());
	}
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    protected $defaultTable ="Preoccupationals";

    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io){  
        
        $time= new FrozenTime();
        $time=$time->i18nFormat('yyyy-MM-dd').' 08:00:00';
        $get_candidates_number = $this->fetchTable()
            ->find('all')
            ->select(['candidate_id'])
           ->where(function(QueryExpression $exp,Query $q){
            $time= new FrozenTime();
            $time=$time->i18nFormat('yyyy-MM-dd').' 08:00:00';
            $time_in_advance=new FrozenTime("+1 day");
            $time_in_advance= $time_in_advance->i18nFormat('yyyy-MM-dd').' 23:00:00';
                return $exp->between('appointment',$time,$time_in_advance);
            }) 
            ->andWhere(function(QueryExpression $exp,Query $q){
                return $exp->isNotNull('appointment');
            })
            -> count();
            $time_in_advance=new FrozenTime("+1 day");
            $time_in_advance= $time_in_advance->i18nFormat('yyyy-MM-dd');
            if ($get_candidates_number > 0){
                $this->MessengerComponent->sentToCenter($get_candidates_number,$time_in_advance);
            }
            
        return null;
    }
}       