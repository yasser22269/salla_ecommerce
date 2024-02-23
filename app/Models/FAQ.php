<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
    ];

    // Custom Methods

    /**
     * Get the excerpt of the answer.
     *
     * @param int $length
     * @return string
     */
    public function getAnswerExcerpt($length = 100)
    {
        return \Illuminate\Support\Str::limit($this->answer, $length);
    }

    /**
     * Get the full answer without any excerpt.
     *
     * @return string
     */
    public function getFullAnswer()
    {
        return $this->answer;
    }

    /**
     * Search FAQs based on a keyword.
     *
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function search($keyword)
    {
        return self::where('question', 'like', '%' . $keyword . '%')
            ->orWhere('answer', 'like', '%' . $keyword . '%')
            ->get();
    }
}
