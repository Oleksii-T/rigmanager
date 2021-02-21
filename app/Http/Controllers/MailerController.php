<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use App\Http\Requests\MailerRequest;
use Illuminate\Http\Request;
use App\Mailer;
use App\User;

class MailerController extends Controller
{
    use Tags;
    /**
     * Display a user`s resourse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mailer.index', ["mailers"=>auth()->user()->mailers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $mailer = Mailer::findOrFail($id);
        if ($mailer->user_id != auth()->user()->id) {
            abort(403);
        }
        return view('mailer.edit', compact('mailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MailerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(MailerRequest $request, $locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $mailer = Mailer::findOrFail($id);
        if ($mailer->user_id != auth()->user()->id) {
            abort(403);
        }
        $input = $request->input();
        if( array_key_exists('tag_encoded', $input) ) {
            $input['tag'] = $input['tag_encoded'];
        }
        if( array_key_exists('region_encoded', $input) ) {
            $input['region'] = $input['region_encoded'];
        }
        //dd($input);
        if ( !$mailer->update($input) ) {
            Session::flash('message-error', __('messages.mailerEditedError'));
        } else {
            Session::flash('message-success', __('messages.mailerEdited'));
        }
        return redirect(loc_url(route('mailer.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id=null)
    {
        $id = $id==null ? $locale : $id;
        $m = Mailer::findOrFail($id);
        if ( $m->user_id!=auth()->user()->id  ) {
            abort(403);
        }
        $m->delete();
        Session::flash('message-success', __('messages.mailerDeleted'));
        return redirect(loc_url(route('mailer.index')));
    }

    public function deleteAll() 
    {
        foreach (auth()->user()->mailers as $m) {
            $m->delete();
        }
        Session::flash('message-success', __('messages.mailerAllDeleted'));
        return redirect(loc_url(route('mailer.index')));
    }

    public function deactivateAll() 
    {
        foreach (auth()->user()->mailers as $m) {
            $m->is_active = false;
            $m->save();
        }
        Session::flash('message-success', __('messages.mailersDeactivated'));
        return redirect(loc_url(route('mailer.index')));
    }

    public function toggle($id)
    {
        // codes: Bag Plan(-2), Bad Auth(-1), Diactivated(0), Activated(1)
        $m = Mailer::findOrFail($id);
        if ( $m->user_id!=auth()->user()->id  ) {
            return json_encode(-1);
        }
        if ($m->is_active) {
            $m->is_active = false;
            $m->save();
            return json_encode(0);
        }
        //if user not subscribed and tryes activate mailer
        if (!auth()->user()->is_standart) {
            return json_encode(-2);
        }
        $m->is_active = true;
        $m->save();
        return json_encode(1);
    }

    public function createByAuthor($user_id)
    {
        if (!auth()->user()->is_standart) {
            return json_encode(['message'=>__('messages.requireStandart'), 'code'=>403]);
        }
        if ( auth()->user()->mailers->count() > 10 ) {
            return json_encode(['message'=>__('messages.mailerTooManyMailers'), 'code'=>404]);
        }
        $mailers = auth()->user()->mailers;
        foreach ($mailers as $mailer) {
            if ($mailer->author == $user_id) {
                return json_encode(['message'=>__('messages.mailerAuthorExists'), 'code'=>404]);
            }
        }
        $input['title'] = User::find($user_id)->name;
        if (mb_strlen($input['title']) > 25) {
            $input['title'] = mb_substr($input['title'], 0, 22) . '...';
        }
        $input['author'] = $user_id;
        $input['condition'] = [2,3,4];
        $input['type'] = [1,2,3,4,5,6];
        $input['thread'] = [1,2];
        $input['role'] = [1,2];
        $mailer = new Mailer($input);
        if (!auth()->user()->mailers()->save($mailer)) {
            return json_encode(['message'=>__('messages.mailerUploadedError'), 'code'=>404]);
        }
        return json_encode(['message'=>__('messages.mailerAddedAuthor'), 'code'=>200]);
    }

    public function createBySearchRequest(Request $request) {
        if (!auth()->user()->is_standart) {
            return json_encode(['message'=>__('messages.requireStandart'), 'code'=>404]);
        }
        if ( auth()->user()->mailers->count() > 10 ) {
            return json_encode(['message'=>__('messages.mailerTooManyMailers'), 'code'=>404]);
        }
        $input = json_decode($request->filters, true);
        //check for empty field 
        if (count($input['condition']) == 0) {
            return json_encode(['message'=>__('messages.mailerEmptyConditionsError'), 'code'=>404]);
        } 
        if (count($input['type']) == 0) {
            return json_encode(['message'=>__('messages.mailerEmptyTypesError'), 'code'=>404]);
        } 
        if (count($input['role']) == 0) {
            return json_encode(['message'=>__('messages.mailerEmptyRolesError'), 'code'=>404]);
        } 
        if (count($input['thread']) == 0) {
            return json_encode(['message'=>__('messages.mailerEmptyThreadsError'), 'code'=>404]);
        } 
        $input['cost_from'] = $input['costFrom'];
        $input['cost_to'] = $input['costTo'];
        $search = json_decode($request->search, true);
        $resByTag = json_decode($request->resByTag, true);
        if ( isset($resByTag['searchedTagMap']) ) {
            $tagUrl = array_key_last( $resByTag['searchedTagMap'] );
            $input['tag'] = $this->getIdByUrl($tagUrl);
        }
        switch ($search['type']) {
            case 'type':
                //$mailerByType = $this->createFromType($search['url']); // type_name and type_codes
                //$input['type'] = array_intersect($input['type'], $mailerByType['type']); // make sure that type from chosen type-group respects the "type" filter
                $input['title'] = trim(preg_replace('/\s+/', ' ', $this->createTitleFromType($search['url']))); //save title of future mail message to array
                break;
            case 'tags':
                $input['tag'] = array_key_last($search['value']);
                $input['title'] = $search['value'][array_key_last($search['value'])];
                break;
            case 'author':
                $input['author'] = $search['value']['id'];
                $input['title'] = $search['value']['name'];
                break;
            case 'text':
                $input['keyword'] = $search['value'];
                $input['title'] = $search['value'];
                break;
            case 'none':
                $input['title'] = __('ui.mailerAllPosts');
                break;
            default:
                return json_encode(['message'=>__('messages.error'), 'code'=>404]);
        }
        // cut the title to insure maximum 25 chars;
        if (mb_strlen($input['title']) > 25) {
            $input['title'] = mb_substr($input['title'], 0, 22) . '...';
        }
        $mailer = new Mailer($input);
        if (!auth()->user()->mailers()->save($mailer)) {
            return json_encode(['message'=>__('messages.mailerUploadedError'), 'code'=>500]);
        }
        return json_encode(['message'=>__('messages.mailerRequestAdded'), 'code'=>200]);
    }

    private function createTitleFromType($typeUrl) {
        switch ($typeUrl) {
            case 'equipment-sell': 
                return __('ui.introSellEq');
            case 'equipment-buy':
                return __('ui.introBuyEq');
            case 'services':
                return __('ui.introSe');
            case 'tenders':
                return __('ui.introTender');
            default: 
                abort(404);
        }
    }
}
