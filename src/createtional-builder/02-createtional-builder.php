<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
class pc {
    protected string $cpu;
    protected string $ram;
    public function getCpu():string {
        return $this->cpu;
    }
    public function getRam():string {
        return $this->ram;
    }
    public function setCpu(string $cpu):void {
        $this->cpu = $cpu ;
    }
    public function setRam(string $ram):void{
        $this->ram = $ram;
    }
}
class pcBuilder {
    protected pc $pc;
    public function __construct(pc $pc)
    {
        $this->pc = $pc;
    }
    public function ram(string $ram):self {
        $this->pc->setRam($ram);
        return $this;
    }
    public function cpu(string $cpu):self {
        $this->pc->setCpu($cpu);
        return $this;
    }
    public function get():pc {
        return $this->pc;
    }
}
interface builder {
    public function build():pc;
}
class normalPcBuilder implements builder {
    protected pcBuilder $builder;
    public function __construct(pcBuilder $builder)
    {
        $this->builder = $builder ;
    }
    public function build():pc
    {
        return $this->builder->cpu('core i5 12700')->ram('24gb ddr5 5000mhz')->get();
    }
}
class gamingPcBuilder implements builder {
    protected pcBuilder $builder;
    public function __construct(pcBuilder $builder)
    {
        $this->builder = $builder ;
    }
    public function build():pc
    {
        return $this->builder->cpu('core i9 12700K')->ram('64gb ddr5 5000mhz')->get();
    }
}
class buyPc {
    public static function buy(builder $builder):pc{
        return $builder->build();
    }
}
$gaming = buyPc::buy(new gamingPcBuilder( new pcBuilder( new pc)));
$normal = buyPc::buy(new normalPcBuilder( new pcBuilder( new pc)));
dd($gaming , $normal);
?>