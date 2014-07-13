<?php namespace SaleBoss\Services\Menu;

use Illuminate\Database\Eloquent\Collection;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\MenuRepositoryInterface;
use SaleBoss\Repositories\MenuTypeRepositoryInterface;

abstract class AbstractBuilder {

    /**
     * Menus that we are working on
     *
     * @var array
     */
    protected $menus;

    /**
     * MenuType that we are working on
     *
     * @var \SaleBoss\Models\MenuType
     */
    protected  $type;

    /**
     * Generated list of menus in tree mode
     *
     * @var array
     */
    protected $generated = array();

    /**
     * @param MenuTypeRepositoryInterface $typeRepo
     * @param MenuRepositoryInterface     $menuRepo
     */
    public function __construct(
        MenuTypeRepositoryInterface $typeRepo,
        MenuRepositoryInterface $menuRepo
    ){
        $this->typeRepo = $typeRepo;
        $this->menuRepo = $menuRepo;
    }

    /**
     * Fetch all results for output
     *
     * @param $type
     *
     * @return array
     */
    public function fetch($type)
    {
        try {
            $this->type = $this->typeRepo->findByMachineName($type);
            $this->menus = $this->menuRepo->getArrayAllInType($this->type);
            return $this->generate();
        }catch (RepositoryException $e){
            return $this->getGenerated();
        }
    }

    /**
     * Generate the menu
     *
     * @return array
     */
    protected  function generate()
    {
        $this->convertToAssoc();
        $this->prepare();

        return $this->getGenerated();
    }

    /**
     * Convert incremental to assoc based on menu id
     *
     * @return void
     */
    protected  function convertToAssoc()
    {
        $menus = [];
        foreach($this->menus as $menu)
        {
            $menus [$menu['id']] = $menu;
        }
        $this->menus = $menus;
    }

    /**
     * Prepare the result based on assoc menus var
     *
     * @return array
     */
    protected function prepare()
    {
        foreach($this->menus as $menu)
        {
            $this->add($menu);
        }
    }

    /**
     * Decider for tree or vertical adding
     *
     * @param $menu
     */
    protected function add($menu)
    {
	    if(empty($menu['id'])) return;
        if( empty($menu['parent_id'])){
            $this->generated[$menu['id']] = $menu;
            return;
        }
        $this->menus[$menu['parent_id']]['children'][$menu['id']] = $menu;
        $this->add($this->menus[$menu['parent_id']]); // Traverse to make the parent_id null
    }

    /**
     * Get the generated result
     *
     * @return array
     */
    protected function getGenerated()
    {
        return $this->generated;
    }

	/**
	 * Generate select array from db collection
	 *
	 * @return array
	 */
	public function select()
	{
		$items = $this->typeRepo->getArrayAllWithMenus();
		$select = [];
		foreach($items as $item){
			$select[$item['id']] = $item['display_name'];
			foreach($item['menus'] as $menu){
				$select[$item['id'] . '_' . $menu['id']] = strip_tags('-' .$menu['title']);
			}
		}
		return $select;
	}
}