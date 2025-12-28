<?php

namespace App\Models\Rekordbox;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string|null $ID
 * @property string|null $FolderPath
 * @property string|null $FileNameL
 * @property string|null $FileNameS
 * @property string|null $Title
 * @property string|null $ArtistID
 * @property string|null $AlbumID
 * @property string|null $GenreID
 * @property int|null $BPM
 * @property int|null $Length
 * @property int|null $TrackNo
 * @property int|null $BitRate
 * @property int|null $BitDepth
 * @property string|null $Commnt
 * @property int|null $FileType
 * @property int|null $Rating
 * @property int|null $ReleaseYear
 * @property string|null $RemixerID
 * @property string|null $LabelID
 * @property string|null $OrgArtistID
 * @property string|null $KeyID
 * @property string|null $StockDate
 * @property string|null $ColorID
 * @property int|null $DJPlayCount
 * @property string|null $ImagePath
 * @property string|null $MasterDBID
 * @property string|null $MasterSongID
 * @property string|null $AnalysisDataPath
 * @property string|null $SearchStr
 * @property int|null $FileSize
 * @property int|null $DiscNo
 * @property string|null $ComposerID
 * @property string|null $Subtitle
 * @property int|null $SampleRate
 * @property int|null $DisableQuantize
 * @property int|null $Analysed
 * @property string|null $ReleaseDate
 * @property string|null $DateCreated
 * @property int|null $ContentLink
 * @property string|null $Tag
 * @property string|null $ModifiedByRBM
 * @property string|null $HotCueAutoLoad
 * @property string|null $DeliveryControl
 * @property string|null $DeliveryComment
 * @property string|null $CueUpdated
 * @property string|null $AnalysisUpdated
 * @property string|null $TrackInfoUpdated
 * @property string|null $Lyricist
 * @property string|null $ISRC
 * @property int|null $SamplerTrackInfo
 * @property int|null $SamplerPlayOffset
 * @property float|null $SamplerGain
 * @property string|null $VideoAssociate
 * @property int|null $LyricStatus
 * @property int|null $ServiceID
 * @property string|null $OrgFolderPath
 * @property string|null $Reserved1
 * @property string|null $Reserved2
 * @property string|null $Reserved3
 * @property string|null $Reserved4
 * @property string|null $ExtInfo
 * @property string|null $rb_file_id
 * @property string|null $DeviceID
 * @property string|null $rb_LocalFolderPath
 * @property string|null $SrcID
 * @property string|null $SrcTitle
 * @property string|null $SrcArtistName
 * @property string|null $SrcAlbumName
 * @property int|null $SrcLength
 * @property string|null $UUID
 * @property int|null $rb_data_status
 * @property int|null $rb_local_data_status
 * @property int|null $rb_local_deleted
 * @property int|null $rb_local_synced
 * @property int|null $usn
 * @property int|null $rb_local_usn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Rekordbox\RekordboxKey|null $rekordboxKey
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereAlbumID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereAnalysed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereAnalysisDataPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereAnalysisUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereArtistID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereBPM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereBitDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereBitRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereColorID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereCommnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereComposerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereContentLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereCueUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDJPlayCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDateCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDeliveryComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDeliveryControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDeviceID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDisableQuantize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereDiscNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereExtInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereFileNameL($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereFileNameS($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereFolderPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereGenreID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereHotCueAutoLoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereISRC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereKeyID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereLabelID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereLyricStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereLyricist($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereMasterDBID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereMasterSongID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereModifiedByRBM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereOrgArtistID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereOrgFolderPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbLocalDataStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbLocalDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbLocalFolderPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbLocalSynced($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRbLocalUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereRemixerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReserved1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReserved2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReserved3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereReserved4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSampleRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSamplerGain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSamplerPlayOffset($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSamplerTrackInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSearchStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereServiceID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSrcAlbumName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSrcArtistName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSrcID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSrcLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSrcTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereStockDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereTrackInfoUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereTrackNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereUUID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereUsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekordboxTrack whereVideoAssociate($value)
 * @mixin \Eloquent
 */
class RekordboxTrack extends RekordboxModel
{
    protected $table = 'djmdContent';

    public function rekordboxKey(): HasOne
    {
        return $this->hasOne(RekordboxKey::class, 'ID', 'KeyID');
    }
}
