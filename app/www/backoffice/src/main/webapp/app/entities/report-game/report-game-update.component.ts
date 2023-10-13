import { Component, OnInit } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';

import { IReportGame, ReportGame } from 'app/shared/model/report-game.model';
import { ReportGameService } from './report-game.service';

@Component({
  selector: 'jhi-report-game-update',
  templateUrl: './report-game-update.component.html',
})
export class ReportGameUpdateComponent implements OnInit {
  isSaving = false;
  rdateDp: any;

  editForm = this.fb.group({
    id: [],
    rdate: [null, [Validators.required]],
    sicboBet: [],
    sicboWin: [],
    sedieBet: [],
    sedieWin: [],
    rocketBet: [],
    rocketWin: [],
    sicboFee: [],
    sedieFee: [],
    rocketFee: [],
  });

  constructor(protected reportGameService: ReportGameService, protected activatedRoute: ActivatedRoute, private fb: FormBuilder) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ reportGame }) => {
      this.updateForm(reportGame);
    });
  }

  updateForm(reportGame: IReportGame): void {
    this.editForm.patchValue({
      id: reportGame.id,
      rdate: reportGame.rdate,
      sicboBet: reportGame.sicboBet,
      sicboWin: reportGame.sicboWin,
      sedieBet: reportGame.sedieBet,
      sedieWin: reportGame.sedieWin,
      rocketBet: reportGame.rocketBet,
      rocketWin: reportGame.rocketWin,
      sicboFee: reportGame.sicboFee,
      sedieFee: reportGame.sedieFee,
      rocketFee: reportGame.rocketFee,
    });
  }

  previousState(): void {
    window.history.back();
  }

  save(): void {
    this.isSaving = true;
    const reportGame = this.createFromForm();
    if (reportGame.id !== undefined) {
      this.subscribeToSaveResponse(this.reportGameService.update(reportGame));
    } else {
      this.subscribeToSaveResponse(this.reportGameService.create(reportGame));
    }
  }

  private createFromForm(): IReportGame {
    return {
      ...new ReportGame(),
      id: this.editForm.get(['id'])!.value,
      rdate: this.editForm.get(['rdate'])!.value,
      sicboBet: this.editForm.get(['sicboBet'])!.value,
      sicboWin: this.editForm.get(['sicboWin'])!.value,
      sedieBet: this.editForm.get(['sedieBet'])!.value,
      sedieWin: this.editForm.get(['sedieWin'])!.value,
      rocketBet: this.editForm.get(['rocketBet'])!.value,
      rocketWin: this.editForm.get(['rocketWin'])!.value,
      sicboFee: this.editForm.get(['sicboFee'])!.value,
      sedieFee: this.editForm.get(['sedieFee'])!.value,
      rocketFee: this.editForm.get(['rocketFee'])!.value,
    };
  }

  protected subscribeToSaveResponse(result: Observable<HttpResponse<IReportGame>>): void {
    result.subscribe(
      () => this.onSaveSuccess(),
      () => this.onSaveError()
    );
  }

  protected onSaveSuccess(): void {
    this.isSaving = false;
    this.previousState();
  }

  protected onSaveError(): void {
    this.isSaving = false;
  }
}
