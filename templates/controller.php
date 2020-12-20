<?php namespace $NAMESPACE$;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use $BASE_NAMESPACE$\Models\$MODEL$;

/**
 * Class $NAME$Controller
 *
 * @package $NAMESPACE$
 */
final class $NAME$Controller extends BaseAuthController
{
    /**
     * Display a listing of $COLLECTION$
     *
     * @return View
     */
    public function index()
    {
        $$COLLECTION$ = $MODEL$::all();
        return view('$COLLECTION$.index', compact('$COLLECTION$'));
    }

    /**
     * Show the form for creating a new $RESOURCE$
     *
     * @return View
     */
    public function create()
    {
        return view('$COLLECTION$.create');
    }

    /**
     * Store a newly created $RESOURCE$ in storage.
     *
     * @return RedirectResponse
     */
    public function store()
    {
        $MODEL$::create(Request::get());
        return Redirect::route('$COLLECTION$.index');
    }

    /**
     * Display the specified $RESOURCE$.
     *
     * @param int $id
     *
     * @return View
     */
    public function show($id)
    {
        $$RESOURCE$ = $MODEL$::findOrFail($id);
        return view('$COLLECTION$.show', compact('$RESOURCE$'));
    }

    /**
     * Show the form for editing the specified $RESOURCE$.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit($id)
    {
        $$RESOURCE$ = $MODEL$::find($id);
        return view('$COLLECTION$.edit', compact('$RESOURCE$'));
    }

    /**
     * Update the specified $RESOURCE$ in storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update($id)
    {
        $$RESOURCE$ = $MODEL$::findOrFail($id);
        $$RESOURCE$->update(Request::get());
        return Redirect::route('$COLLECTION$.index');
    }

    /**
     * Remove the specified $RESOURCE$ from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $MODEL$::destroy($id);
        return Redirect::route('$COLLECTION$.index');
    }
}
