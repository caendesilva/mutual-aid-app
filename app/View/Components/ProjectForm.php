<?php

namespace App\View\Components;

use App\Models\Offer;
use App\Models\Request;
use Illuminate\View\Component;

/**
 * This component bridges the gap between Request and Offer forms as they are very similar.
 * For this reason, Requests and Offers are semantically considered "Projects".
 * The same form component can be used for both creating new, and updating
 * existing Projects using the same base component.
 */
class ProjectForm extends Component
{
    /**
     * The model to create/update
     *
     * @var Offer|Request
     */
    public Offer|Request $model;

    /**
     * The name of the model
     * 
     * @var string
     */
    public string $modelName;

    /**
     * The form action destination
     * 
     * @var string
     */
    public string $formActionURL;

    /**
     * The HTTP Verb the form uses
     * 
     * @var string
     */
    public string $formMethod = "POST";

    /**
     * The action the form offers.
     * Must be create or update
     * 
     * @var string
     */
    public string $actionType = "create";

    /**
     * The localization key prefix for form inputs
     * 
     * @var string
     */
    public string $langKey;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Offer|Request $model)
    {
        $this->model = $model;

        $this->modelName = basename(get_class($model));

        // Get the base route from the route name and determine which action is being made.
        $route = explode('.', request()->route()->getName());

        $this->actionType = $route[1];
        // Determine which resource action to take (store/update)
        switch ($this->actionType) {
            case 'create':
                $formAction = 'store';
                $this->formMethod = 'POST';
                break;
            case 'edit':
                $formAction = 'update';
                $this->formMethod = 'PATCH';
                break;
            default:
                abort(400, 'Invalid route action.');
                break;
        }
        $this->formActionURL = route(($route[0] . '.' . $formAction), $this->model);

        $this->langKey = strtolower(implode('.', ['form-input', $this->modelName, $this->actionType, '']));
        view()->share(['langKey' => $this->langKey]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project-form');
    }
}