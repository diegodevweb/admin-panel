<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    public static function getModelLabel(): string
    {
        return __('Tasks');
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Tarefas';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->translateLabel()
                    ->label('Nome')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->translateLabel()
                    ->label('Descrição')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'backlog' => 'Backlog',
                        'done' => 'Concluída',
                        'doing' => 'Em andamento',
                        'review' => 'Revisão',
                        'testing' => 'Testes',
                    ])
                    ->required()
                    ->translateLabel()
                    ->label('Status'),
                Forms\Components\Select::make('priority')
                    ->options([
                        'low' => 'Baixa',
                        'medium' => 'Média',
                        'high' => 'Alta',
                    ])
                    ->required()
                    ->translateLabel()
                    ->label('Prioridade'),
                Forms\Components\Select::make('user_id')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\DatePicker::make('due_date')
                    ->translateLabel()
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->minDate(now()->addDay())
                    ->closeOnDateSelection()
                    ->label('Data de Entrega'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                    ->label('Prioridade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de Entrega')
                    ->searchable(),
            ])
            ->groups(['user.name'])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
